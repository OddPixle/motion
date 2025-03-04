<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditorController extends Controller
{
    public function store(Request $request)
{
    $data = $request->input('data');

    // Example: Save data to the database or process it as needed
    // EditorContent::create(['content' => json_encode($data)]);

    return response()->json(['status' => 'success', 'data' => $data]);
}

}
