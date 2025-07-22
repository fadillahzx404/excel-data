<?php

namespace App\Http\Controllers;

use App\Models\Datas;
use App\Models\DataDetails;
use App\Models\Category;
use App\Models\ColoringDataCol;
use App\Models\ColoringDataRow;
use Illuminate\Http\Request;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Datas::all();
        return view('datas.index', ['datas' => $datas]);
    }

    public function create(Request $request)
    {
        $categories = Category::all();
        $header = $request->all();

        return view('datas.create', ['categories' => $categories, 'header' => $header]);
    }

    public function check(Request $request)
    {
        $jumlah = $request->all();
        $datas = Datas::all();

        return view('datas.add_title', ['jumlah' => $jumlah, 'datas' => $datas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $handsontableData = json_decode($request->input('handsontable_data'), true);

        dd($handsontableData);

        $data = $request->all();

        $data['header_table'] = $handsontableData['colheaders'];
        $data['value_table'] = $handsontableData['data'];

        $item = new Datas();

        $dataArray = [
            'nama_data' => $data['nama_data'],
            'category_id' => $data['category_id'],
        ];

        $item = Datas::create($dataArray);

        DataDetails::create([
            'datas_id' => $item->id,
            'header_table' => json_encode($data['header_table']),

            'value_table' => json_encode($data['value_table']),
        ]);

        return redirect()->route('datas.index')->with('Success', 'Datas Created !!');
    }

    public function edit(Datas $datas, $id)
    {
        $data = Datas::with('dataDetails')->findOrFail($id);
        $categories = Category::all();


        return view('datas.edit', ['data' => $data, 'categories' => $categories]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Datas $datas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update_col(Request $request, Datas $datas)
    {
        $data = $request->all();
        $headerRaw = $data['cell'];  // ex: "TEST A,0,1"
        [$headerName, $rowIndex] = explode(',', $headerRaw);

        if ($data['radio'] != 'notProcess') {

            $coloring = $data['radio'] == 'success' ? '#422ad5' : '#00d390';

            ColoringDataCol::create([
                'data_details_id' => $data['data_details_id'],
                'user_id' => $data['user_id'],
                'header' => $headerName,
                'column' => $rowIndex,
                'color_col' => $coloring,
            ]);

            $head = $headerName;

            return redirect()
                ->route('datas.edit', $data['datas_id'])
                ->with('Success', "Warna Kolom $head telah ditambahkan");
        } else {
            $dataCol = ColoringDataCol::where('header', $headerName)->where('column', $rowIndex)->first();

            if ($dataCol)  $dataCol->delete();

            $head = $headerName;

            return redirect()
                ->route('datas.edit', $data['datas_id'])
                ->with('Success', "Warna Kolom $head telah dihapus");
        }
    }

    public function update(Request $request, Datas $datas, $id)
    {
        $handsontableData = json_decode($request->input('handsontable_data'), true);
        $data = $request->all();
        $item = Datas::findOrFail($id);


        Datas::where('id', $id)->update(['nama_data' => $data['nama_data'], 'category_id' => $data['category_id']]);
        DataDetails::where('datas_id', $id)->update([
            'header_table' => json_encode($handsontableData['colheaders']),
            'value_table' => json_encode($handsontableData['data']),
        ]);


        return redirect()->route('datas.index')->with('Success', 'Data Berhasil Di Edit !!');
    }
    public function destroy($id)
    {
        $item = Datas::findOrFail($id);

        $dataDetails = DataDetails::where('datas_id', $id)->get();
        if ($dataDetails) {
            foreach ($dataDetails as $detail) {
                $detail->ColoringCol()->delete();
                $detail->ColoringRow()->delete();
                $detail->delete();
            }
        }

        $item->delete();

        return redirect()->route('datas.index')->with('Success', 'Data telah dihapus !');
    }

    public function destroy_col(Request $request)
    {
        $data = $request->all();

        $item = ColoringDataCol::findOrFail($data['id']);

        $head = $item->header;

        $item->delete();

        return redirect()
            ->route('datas.edit', $data['datas_id'])
            ->with('Success', "Warna pada kolom $head telah dihapus !");
    }

    public function destroy_row(Request $request)
    {
        $data = $request->all();

        $item = ColoringDataRow::findOrFail($data['id']);

        $indx = $item->index_row + 1;

        $item->delete();

        return redirect()
            ->route('datas.edit', $data['datas_id'])
            ->with('Success', "Warna pada baris $indx telah dihapus !");
    }
}
