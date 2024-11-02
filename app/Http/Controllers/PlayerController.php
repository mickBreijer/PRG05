<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller
{
    public function show($id)
    {
        $player = Player::find($id);  // Retrieve player by ID

        // Track the number of viewed players in the session
        $viewedPlayersCount = session('viewedPlayersCount', 0);
        $viewedPlayersCount++;
        session(['viewedPlayersCount' => $viewedPlayersCount]);

        // Show a flash message after viewing 3 players
        if ($viewedPlayersCount == 3) {
            session()->flash('success', 'Je hebt nu 3 spelers bekeken! Je kunt nu een team aanmaken.');
        }

        return view('players.show', compact('player'));
    }

    public function index(Request $request)
    {
        $playerSearchTerm = $request->input('player_search', '');  // Search term for player name
        $position = $request->input('position', '');  // Filter by position

        $players = Player::when($playerSearchTerm, function ($query) use ($playerSearchTerm) {
            return $query->where('name', 'like', '%' . $playerSearchTerm . '%');
        })
            ->when($position, function ($query) use ($position) {
                return $query->where('position', $position);
            })
            ->get();

        return view('players.index', compact('players', 'playerSearchTerm', 'position'));
    }

    public function create()
    {
        if (Auth::user()->is_admin !== 1) {  // Only allow admin users to create a player
            return redirect()->route('players.index');
        }
        $players = Player::all();
        return view('players.create', compact('players'));
    }

    public function store(Request $request)
    {
        // Validate player data
        $validated = $request->validate([
            'name' => 'required|max:255|unique:players',
            'club' => 'required',
            'value' => 'required|numeric|min:0',
            'position' => 'required',
            'eligibility' => 'required|numeric'
        ]);

        // Create and save a new player
        $player = new Player();
        $player->name = $validated['name'];
        $player->club = $validated['club'];
        $player->value = $validated['value'];
        $player->position = $validated['position'];
        $player->points = 0;
        $player->eligibility = 0;
        $player->save();

        return redirect(route('players.index'))->with('success', 'Speler succesvol aangemaakt!');
    }

    public function edit(Player $player)
    {
        return view('players.edit', compact('player'));
    }

    public function update(Request $request, Player $player)
    {
        // Validate updated player data
        $validated = $request->validate([
            'name' => 'required|max:255|unique:players,name,' . $player->id,
            'club' => 'required',
            'value' => 'required|numeric|min:0',
            'position' => 'required',
            'eligibility' => 'required|numeric'
        ]);

        // Update player with validated data
        $player->name = $validated['name'];
        $player->club = $validated['club'];
        $player->value = $validated['value'];
        $player->position = $validated['position'];
        $player->eligibility = $validated['eligibility'];
        $player->save();

        return redirect()->route('players.index')->with('success', 'Speler succesvol bijgewerkt!');
    }

    public function destroy(Player $player)
    {
        $player->delete();  // Delete player

        return redirect()->route('players.index')->with('success', 'Player deleted successfully!');
    }
}
