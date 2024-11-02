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
        $team = Team::with(['players', 'substitutedPlayers'])->findOrFail($id);  // Retrieve team with players and substituted players
        return view('teams.show', compact('team'));
    }

    public function index(Request $request)
    {
        $playerSearchTerm = $request->input('player_search', '');  // Get player search term

        $teams = Team::with('user', 'players')
            ->when($playerSearchTerm, function ($query, $playerSearchTerm) {
                return $query->whereHas('players', function ($query) use ($playerSearchTerm) {
                    $query->where('name', 'like', '%' . $playerSearchTerm . '%');  // Filter teams by player name
                });
            })
            ->get();

        return view('teams.index', compact('teams', 'playerSearchTerm'));
    }

    public function create()
    {
        // Check if the user has viewed at least 3 players
        $viewedPlayersCount = session('viewedPlayersCount', 0);
        if ($viewedPlayersCount < 3) {
            return redirect()->route('teams.index')->with('error', 'Je moet minstens 3 spelers bekijken voordat je een team kunt aanmaken.');
        }

        $players = Player::all();  // Get all players for selection in team creation
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

        $success = $team->save();  // Save the team

        if ($success) {
            // Attach players to the team
            $team->players()->attach($validated['players']['keeper']);
            $team->players()->attach($validated['players']['verdediger']);
            $team->players()->attach($validated['players']['middenvelder']);
            $team->players()->attach($validated['players']['aanvaller']);
        }

        return redirect(route('teams.index'))->with('success', 'Team created and players assigned successfully!');
    }

    public function edit(Team $team)
    {
        if(Auth::id() === $team->user_id || Auth::user()->is_admin == 1) {  // Allow editing if user owns team or is admin
            $allPlayers = Player::all();  // Get all players
            $currentPlayerIds = $team->players->pluck('id')->toArray();  // Get IDs of current team players
            $availablePlayers = [];

            foreach ($allPlayers as $player) {
                if (!in_array($player->id, $currentPlayerIds)) {
                    $availablePlayers[$player->position][] = $player;  // Collect players not in the team, grouped by position
                }
            }
        } else {
            return view('home');  // Redirect non-authorized users to home
        }

        return view('teams.edit', compact('team', 'availablePlayers'));
    }

    public function update(Request $request, Team $team)
    {
        $substitutions = $request->input('substitutions');

        foreach ($substitutions as $playerId => $substituteId) {
            if ($substituteId) {
                $team->players()->updateExistingPivot($playerId, ['substitution' => 1]);  // Mark current player as substituted
                $team->players()->attach($substituteId, ['substitution' => 0]);  // Attach new player in substitution role
            }
        }

        return redirect()->route('teams.show', $team->id)->with('success', 'Team updated successfully!');
    }

    public function destroy(Team $team)
    {
        $team->players()->detach();  // Detach all players from team
        $team->delete();  // Delete the team

        return redirect()->route('teams.index')->with('success', 'Team deleted successfully!');
    }

    public function toggleActive(Team $team)
    {
        $team->is_active = !$team->is_active;  // Toggle team's active status
        $team->save();

        return redirect()->route('admin.index')->with('success', 'Team status updated successfully.');
    }
}
