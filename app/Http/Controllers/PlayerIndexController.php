<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerIndexController extends Controller
{
    public function index()
    {
        $players = Player::all();
        return view('players', compact('players'));
    }
}
