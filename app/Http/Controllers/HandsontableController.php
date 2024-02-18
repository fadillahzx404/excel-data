<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HandsontableController extends Controller
{
    <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyModel; // replace with your actual model name

class HandsontableController extends Controller
{
    public function save(Request $request)
    {
        // validate the request
        $validated = $request->validate([
            'data' => 'required|array',
        ]);

        // save the data to the database
        foreach ($validated['data'] as $row) {
            MyModel::updateOrCreate(
                ['id' => $row['id']],
                $row
            );
        }

        // return a JSON response
        return response()->json(['success' => true]);
    }
}
}
