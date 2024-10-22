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
        $validated = $request -> validate(
            ['name' => 'required|max:255|unique:players']
        );
        $player = new player();
        $player->name = $request->input('name');

        $player->user_id = Auth::user()->id;
        $player->save();
        return redirect(route('players.index'));
    }

    public function edit(Player $player)
    {

    }

    public function update(Request $request, Player $player)
    {

    }

    public function destroy(Player $player)
    {

    }
}


