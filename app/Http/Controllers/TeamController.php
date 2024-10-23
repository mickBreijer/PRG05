<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function show($id)
    {
        $team = Team::find($id);
        $team->load('players');
        return view('teams.show', compact('team'));
    }

    public function index()
    {
        $teams = Team::all();
        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        $players = Player::all();
        return view('teams.create', compact('players'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:teams',
            'players.keeper' => 'required|exists:players,id|distinct',
            'players.verdediger' => 'required|array|min:4|max:4',
            'players.verdediger.*' => 'exists:players,id|distinct',
            'players.middenvelder' => 'required|array|min:3|max:3',
            'players.middenvelder.*' => 'exists:players,id|distinct',
            'players.aanvaller' => 'required|array|min:3|max:3',
            'players.aanvaller.*' => 'exists:players,id|distinct',
        ]);

        $team = new Team();
        $team->name = $request->input('name');
        $team->user_id = Auth::user()->id;

        $success = $team->save();

        if ($success) {
            $team->players()->attach($validated['players']['keeper']);
            $team->players()->attach($validated['players']['verdediger']);
            $team->players()->attach($validated['players']['middenvelder']);
            $team->players()->attach($validated['players']['aanvaller']);
        }

        // Redirect to the teams index page with a success message
        return redirect(route('teams.index'))->with('success', 'Team created and players assigned successfully!');
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
