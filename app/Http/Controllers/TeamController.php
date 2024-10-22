<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function show($id)
    {
        $team = Team::find($id);
        return view('team', compact('team'));
    }

    public function index()
    {
        $teams = team::all();
        return view('teams', compact('teams'));
    }
}
