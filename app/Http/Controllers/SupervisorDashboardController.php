<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SupervisorDashboardController extends Controller
{
    public function show()
    {
        $user= Auth::user();
        return view('hsbc/supervisordashboard/home',['user'=>$user]);
    }
}
