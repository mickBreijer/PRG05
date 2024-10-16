<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function show($id)
    {
        $player = Player::find($id);
        return view('player', compact('player'));
    }

    public function index()
    {
        $players = Player::all();
        return view('players', compact('players'));
    }
}
