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
        $team = Team::with(['players', 'substitutedPlayers'])->findOrFail($id);
        return view('teams.show', compact('team'));
    }

    public function index(Request $request)
    {
        $playerSearchTerm = $request->input('player_search', '');

        $teams = Team::with('user', 'players')
            ->when($playerSearchTerm, function ($query, $playerSearchTerm) {
                return $query->whereHas('players', function ($query) use ($playerSearchTerm) {
                    $query->where('name', 'like', '%' . $playerSearchTerm . '%');
                });
            })
            ->get();

        return view('teams.index', compact('teams', 'playerSearchTerm'));
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

        return redirect(route('teams.index'))->with('success', 'Team created and players assigned successfully!');
    }

    public function edit(Team $team)
    {
        $allPlayers = Player::all();
        $currentPlayerIds = $team->players->pluck('id')->toArray();
        $availablePlayers = [];

        foreach ($allPlayers as $player) {
            if (!in_array($player->id, $currentPlayerIds)) {
                $availablePlayers[$player->position][] = $player;
            }
        }

        return view('teams.edit', compact('team', 'availablePlayers'));
    }

    public function update(Request $request, Team $team)
    {
        $substitutions = $request->input('substitutions');

        foreach ($substitutions as $playerId => $substituteId) {
            if ($substituteId) {
                $team->players()->updateExistingPivot($playerId, ['substitution' => 1]);
                $team->players()->attach($substituteId, ['substitution' => 0]);
            }
        }

        return redirect()->route('teams.show', $team->id)->with('success', 'Team updated successfully!');
    }

    public function destroy(Team $team)
    {
        $team->players()->detach();
        $team->delete();

        return redirect()->route('teams.index')->with('success', 'Team deleted successfully!');
    }
}
