<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    function index() {
        $testdata = Test::all();

        return view('test', compact('testdata'));
    }

    function changeStatus(Request $request) {
        $testdata = Test::find($request->data_id);

        $testdata->status_test = $request->status;
        $testdata->save();

    }
}
