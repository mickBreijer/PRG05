<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamIndexController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        return view('teams', ['teams' => $teams]);
    }
}
