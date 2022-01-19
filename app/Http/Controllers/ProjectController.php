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
        $projectData= Project::with('users')->get(); // output berupa collection
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
        $projectPivot = Project::with('users')->get();
        $taskData = Task::where('project_id', $project->id)->get();
        $assignUser = User::all();
        return view('dashboard.project', compact('pageTitle','projectData', 'taskData', 'assignUser', 'projectPivot'));
    }

    public function addMember(Request $request){

        $request->validate([
            'member' => 'required|email'
        ]);

        $project = Project::find($request->projectID);

        $userData = User::where('email', $request->member)->get()->first();
        // ddd($userData);
        if ($userData == null){

            return redirect()->back()->with('addMemberFail', $request->member);
            // return "Fail bro";
        }

        $user = User::find($userData->id);
        $project->users()->attach($user);

        return redirect()->back()->with('addMemberSuccess', $user->username);
    }

    public function kickMember(Request $request){

        $project = Project::find($request->projectID);
        $userData = User::where('email', $request->emailMember)->get()->first();

        $user = User::find($userData->id);
        $user->projects()->detach($project);

        return redirect()->back()->with('kickMemberSuccess', $user->username);

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
        $request->validate([
            'projectname' => 'required'
        ]);

        $project->name = $request->projectname;
        $project->description = $request->projectdesc;
        $project->save();


        return redirect()->back()->with('updateProjectSuccess', 'Project Updated');

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
