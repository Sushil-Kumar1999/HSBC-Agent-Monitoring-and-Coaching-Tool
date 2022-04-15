<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentDashboardController extends Controller
{
    public function show()
    {
        //$user= Auth::user();
        return view('hsbc/agentdashboard/home');
    }
}
