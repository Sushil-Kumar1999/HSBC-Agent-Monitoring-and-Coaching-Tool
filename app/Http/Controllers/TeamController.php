<?php

namespace App\Http\Controllers;
use App\Models\Team;

class TeamController extends Controller
{
    public function apiIndex()
    {
        return Team::all();
    }
}
