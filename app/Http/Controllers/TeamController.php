<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function show($id)
    {
        $team = Team::find($id);
        return view('team.show', compact('team'));
    }

    public function index()
    {
        $teams = team::all();
        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        $teams = Team::all();
        return view('teams.create', compact('teams'));
    }

    public function store(Request $request)
    {
        $validated = $request -> validate(
            ['name' => 'required|max:255|unique:team_name']
        );
        $team = new Team();
        $team->team_name = $request->input('name');

        $team->user_id = Auth::user()->id;
        $team->save();
        return redirect(route('teams.index'));
    }

    public function edit(Team $team)
    {

    }

    public function update(Request $request, Team $team)
    {

    }

    public function destroy(Team $team)
    {

    }
}


