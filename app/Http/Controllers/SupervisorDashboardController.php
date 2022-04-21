<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SupervisorDashboardController extends Controller
{
    public function show()
    {
        $supervisor = Auth::user();
        return view('hsbc/supervisordashboard/home', ['supervisor' => $supervisor]);
    }
}
