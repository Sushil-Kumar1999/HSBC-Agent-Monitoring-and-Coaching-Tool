<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function apiIndex(Request $request)
    {
        $query = User::query()->with('metrics');
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

}
