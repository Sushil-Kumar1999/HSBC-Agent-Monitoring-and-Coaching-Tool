<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Team;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('hsbc.admin.index');
    }

    public function showWebAgents(User $user)
    {
        $webAgents = $user->webAgents();

        return view('hsbc.admin.showWebAgents')
            ->with("webAgents", $webAgents);
    }

    public function showSupervisors(User $user)
    {
        $supervisors = $user->supervisors();

        return view('hsbc.admin.showSupervisors')
            ->with("supervisors", $supervisors);
    }

    public function webAgentDetails(User $user)
    {
        $supervisor = $user->team()->first()->supervisor;
        return view('hsbc.admin.webAgentDetails')
            ->with("user", $user)
            ->with("supervisor", $supervisor);
    }

    public function supervisorDetails(User $user)
    {
        $team = $user->supervises;
        if (!$team == null) { 
            $webAgents = $team->members;
        } else {
            $webAgents = [];
        }
        return view('hsbc.admin.supervisorDetails')
            ->with("user", $user)
            ->with("webAgents", $webAgents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createWebAgent()
    {
        $teams = Team::all();
        return view('hsbc.admin.createWebAgent')
            ->with("teams", $teams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createSupervisor()
    {
        return view('hsbc.admin.createSupervisor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeWebAgent(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'team_name' => 'required',
        ]);
        
        $w = new User;
        $w->id = time();
        $w->name = $validatedData['name'];
        $w->email = $validatedData['email'];
        $w->team_id = Team::get()->where('name', $validatedData['team_name'])->first()->team_id;
        $w->role = 'Agent';
        $w->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; //password
        $w->save();

        session()->flash('message', 'Web Agent was created.');
        return redirect()->route('admin.showWebAgents');
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSupervisor(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'team_name' => 'required',
        ]);
        
        $s = new User;
        $s->id = time();
        $s->name = $validatedData['name'];
        $s->email = $validatedData['email'];
        $s->team_id = 0;
        $s->role = 'Supervisor';
        $s->password = 'password';
        $s->save();

        $t = new Team;
        $t->team_id = time();
        $t->supervisor_id = $s->id;
        $t->name = $validatedData['team_name'];
        $t->save();

        session()->flash('message', 'Supervisor was created.');
        return redirect()->route('admin.showSupervisors');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function editWebAgent(User $user)
    {
        $teams = Team::all();
        return view('hsbc.admin.editWebAgent')
            ->with("user", $user)
            ->with("teams", $teams);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function editSupervisor(User $user)
    {
        return view('hsbc.admin.editSupervisor')
            ->with("user", $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateWebAgent(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|max:255',
            'email' => 'nullable|max:255',
            'team_name' => 'nullable|max:255',
        ]);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->team_id = Team::get()->where('name', $validatedData['team_name'])->first()->team_id;
        $user->save();

        session()->flash('message', 'Web Agent was Edited.');
        return redirect()->route('admin.webAgentDetails', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateSupervisor(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|max:255',
            'email' => 'nullable|max:255',
            'team_name' => 'nullable|max:255',
        ]);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->save();

        $t = $user->supervises()->first();
        $webAgents = $t->members;
        $t->name = $validatedData['team_name'];
        $t->save();

        foreach($webAgents as $webAgent){
            $webAgent->team()->team_name = $validatedData['team_name'];
            $webAgent->save();
        }

        session()->flash('message', 'Supervisor was Edited.');
        return redirect()->route('admin.supervisorDetails', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyWebAgent(User $user)
    {
        $user->delete();
        session()->flash('message', 'Web Agent was deleted.');
        return redirect()->route('admin.showWebAgents')
            ->with('message', 'Web Agent was deleted.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroySupervisor(User $user)
    {
        $user->delete();
        session()->flash('message', 'Supervisor was deleted.');
        return redirect()->route('admin.showSupervisors')
            ->with('message', 'Supervisor was deleted.');
    }
}