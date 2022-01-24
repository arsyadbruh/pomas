<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    private $project_ID;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "mytask";
        $userID = Auth::user()->id;
        $taskData = Task::where('user_id', $userID)->get();
        $projectData= Project::with('users')->get();

        return view('dashboard.mytask', compact('pageTitle', 'taskData', 'projectData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ddd($request->taskdate);
        $request->validate([
            'task' => 'required',
            'taskdate' => 'required|date'
        ]);

        $task = new Task;
        $task->name = $request->task;
        $task->deadline = $request->taskdate;
        $task->project_id = $request->projectid;
        $task->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $project_id)
    {
        $task = Task::find($id);
        $pageTitle = "myproject";
        $projectID = $project_id;

        return view('dashboard.detailTask', compact('task', 'pageTitle', 'projectID'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $projectID = $task->project_id;
        $project = Project::find($projectID);

        if(!Gate::denies('member', [$project])){
            return redirect()->back()->with('error', 'You dont have permission');
        }

        $request->validate([
            'taskname' => 'required',
            'taskdate' => 'required',
        ]);

        $task->name = $request->taskname;
        $task->description = $request->taskdesc;
        $task->deadline = $request->taskdate;
        $task->save();

        return redirect()->back()->with('success', 'Task Updated');

    }

    public function toUpdate(Request $request){
        $task = Task::find($request->data_id);

        $task->status = $request->status;
        $task->save();
    }

    function assignUser(Request $request) {
        $task = Task::find($request->data_id);

        if ($request->selected === "none"){
            $task->user_id = null;
            $task->save();
        } else {
            $task->user_id = $request->selected;
            $task->save();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);

        $task->delete();
        return redirect()->back();
    }
}
