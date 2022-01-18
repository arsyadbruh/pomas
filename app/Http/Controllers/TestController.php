<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\TestOption;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    function index() {
        $testdata = Test::all();
        $testOptions = TestOption::all();

        return view('test', compact('testdata', 'testOptions'));
    }

    function changeStatus(Request $request) {
        $testdata = Test::find($request->data_id);

        $testdata->status_test = $request->status;
        $testdata->save();

    }

    function changeOption(Request $request) {
        $testdata = Test::find($request->data_id);

        if ($request->selected === "none"){
            $testdata->option_id = null;
            $testdata->save();
        } else {
            $testdata->option_id = $request->selected;
            $testdata->save();
        }

    }
}
