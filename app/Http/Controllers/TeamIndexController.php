<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamIndexController extends Controller
{
    public function index()
    {
        $teams = team::all();
        return view('teams', compact('teams'));
    }
}
