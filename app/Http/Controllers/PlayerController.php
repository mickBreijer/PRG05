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
        ]);

        $player = new Player();
        $player->name = $validated['name'];
        $player->club = $validated['club'];
        $player->value = $validated['value'];
        $player->position = $validated['position'];
        $player->points = 0;
        $player->eligibility = 0;
//        $player->user_id = Auth::user()->id;
        $player->save();

        return redirect(route('players.index'))->with('success', 'Speler succesvol aangemaakt!');
    }

    public function edit(Player $player)
    {

    }

    public function update(Request $request, Player $player)
    {

    }
    public function destroy(player $player)
    {
        $player->delete();

        return redirect()->route('players.index')->with('success', 'Player deleted successfully!');
    }
}


