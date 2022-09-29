<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use function GuzzleHttp\Promise\all;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "myproject";
        $user = Auth::user()->id;
        $projectData= Project::with('users')->get(); // output berupa collection
        // ddd($projectData);
        return view('dashboard.index', compact('pageTitle', 'projectData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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

        if($project->save()) {
            $projectdata = Project::latest()->first();
            $user->projects()->attach($projectdata, ['role' => 'owner']);
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
        $pageTitle = "myproject";
        $taskData = Task::where('project_id', $project->id)->get();
        $assignUser = User::all();
        $user = User::find(Auth::user()->id);

        // if (!$user->projectRole('owner', $project->id, $user->id)){
            // ddd($user->projectRole('owner', $project->id, $user->id));
        //     abort(403, 'You dont have permission in this project');
        // }

        $isOwner = Gate::allows('owner', [$project]);
        $isMember = Gate::allows('member', [$project]);
        $isAdmin = Gate::allows('admin', [$project]);

        // jika bukan owner atau member atau admin maka tampilkan halaman abort(404, Page not found)
        if($isOwner || $isMember || $isAdmin){
            return view('dashboard.project', compact('pageTitle','project', 'taskData', 'assignUser', 'user'));
        }


        abort(404, 'Page not Found');
        // return ($isAdmin || $isMember || $isOwner) ? 'true' : 'false';
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
        $project->users()->attach($user, ['role' => 'member']);

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

    public function updateMember(Request $request) {
        $user = User::find($request->selectedUser);

        DB::table('project_teams')
            ->where('project_id', $request->project_id)
            ->where('user_id', $request->selectedUser)
            ->update(['role' => $request->selectedRole]);

        return redirect()->back()->with('updateRole', $user->username);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        // Selain owner tidak punya hak untuk menghapus project
        if(Gate::denies('owner', [$project])){
            return redirect()->back()->with('denied', 'You dont have Permission');
        }

        $projectName = $project->name;
        $task = Task::where('project_id', $project->id);
        $task->delete();
        DB::table('project_teams')->where('project_id', $project->id)->delete();
        $project->delete();

        return redirect()->route('project.index')->with('deletedProject', 'Project'.$projectName.'has deleted');
    }

    public function exportProject(Request $request) {
        $project = Project::find($request->projectID);

        // if user is member then block and print error
        if(!Gate::denies('member', [$project])){
            return redirect()->back()->with('denied', 'You dont have Permission');
        }

        $userData = User::all();
        $taskData = Task::where('project_id', $project->id)->get();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('dashboard.exportProject', compact('project', 'userData', 'taskData'));
        return $pdf->stream($project->name.'.pdf');

    }
}
