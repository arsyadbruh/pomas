<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    private $projectID;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "myproject";
        $projectData= Project::with('users')->get();
        return view('dashboard.index', compact('pageTitle', 'projectData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $pageTitle = "myproject";

        return view('dashboard.createProject', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $project = new Project();
        $user = User::find(Auth::user()->id);

        $request->validate([
           'name' => 'required',
           'description' => 'required'
        ]);

        $project->name = $request->name;
        $project->description = $request->description;
        $project->owner_id = $user->id;

        if($project->save()) {
            $projectdata = Project::latest()->first();
            $user->projects()->attach($projectdata);
        }

        return redirect()->route('project.index');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
        $pageTitle = "myproject";
        $projectData = $project;
        $taskData = Task::where('project_id', $project->id)->get();
        return view('dashboard.project', compact('pageTitle','projectData', 'taskData'));
    }

    public function addMember(Request $request){

        $request->validate([
            'member' => 'required|email'
        ]);

        $project = Project::find($request->projectID);

        $userData = User::where('email', $request->member)->get()->first();
        $user = User::find($userData->id);
        $project->users()->attach($user);

        return redirect()->back()->with('addMemberSuccess', 'Success Add Member');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
