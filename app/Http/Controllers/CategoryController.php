<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Category::all();
        return view('category.index', ['datas' => $datas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        Category::create($data);

        return redirect()->route('category.index')->with('Success', 'Category telah ditambahkan !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $data = Category::findOrFail($category->id);
        return view('category.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->all();

        $item = Category::findorFail($category->id);

        $item->update($data);

        return redirect()->route('category.index')->with('Success', 'Category berhasil diubah !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, $id)
    {
        $item = Category::findOrFail($id);

        $item->delete();

        return redirect()->route('datas.index')->with('Success', 'Data telah dihapus !');
    }
}
