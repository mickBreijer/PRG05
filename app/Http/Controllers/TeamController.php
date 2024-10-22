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
        // Validate the input
        $validated = $request->validate([
            'name' => 'required|max:255|unique:teams',
            'players' => 'required|array|min:11|max:11',
            'players.*' => 'exists:players,id',
        ]);

        $team = new Team();
        $team->name = $request->input('name');
        $team->user_id = Auth::user()->id;
        $success = $team->save();

        if ($success) {
            $team->players()->attach($validated['players']);
        }

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
