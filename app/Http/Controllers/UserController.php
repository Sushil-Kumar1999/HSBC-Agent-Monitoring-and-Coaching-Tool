<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function apiIndex(Request $request)
    {
        $query = User::query()->with('metrics')->with('team')->orderBy('name', 'ASC');
        $role = $request->input('role');
        $page = $request->input('page');

        if($role)
        {
            $query->where('role', $role);
        }

        if($page)
        {
            $skip = ($page-1) * 10;
            $query->skip($skip)->take(10);
        }

        return $query->get();
    }

    public function apiRemoveFromTeam(User $user)
    {
        $user->team_id = 0;
        $user->save();

        return response('User removed from team successfully', 200);
    }

    public function apiAddToTeam(Request $request, User $user)
    {
        $user->team_id = $request->input('teamId');
        $user->save();

        return response('User added to team successfully', 200);
    }
}
