<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller
{
    public function show($id)
    {
        $player = Player::find($id);
        return view('players.show', compact('player'));
    }

    public function index()
    {
        $players = Player::all();
        return view('players.index', compact('players'));
    }

    public function create()
    {
        if (Auth::user()->is_admin !== 1) {
            return redirect()->route('players.index');
        }
        $players = Player::all();
        return view('players.create', compact('players'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|max:255|unique:players',
            'club' => 'required',
            'value' => 'required|numeric|min:0',
            'position' => 'required',
            'eligibility' => 'required|numeric'
        ]);

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
        $validated = $request->validate([
            'name' => 'required|max:255|unique:players,name,' . $player->id,
            'club' => 'required',
            'value' => 'required|numeric|min:0',
            'position' => 'required',
            'eligibility' => 'required|numeric'

        ]);

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
        $player->delete();

        return redirect()->route('players.index')->with('success', 'Player deleted successfully!');
    }
}


