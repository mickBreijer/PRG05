<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->is_admin == 1) {  // Check if the user is authenticated and an admin
            $players = Player::all();  // Get all players
            $teams = Team::all();      // Get all teams
            return view('admin.index', compact('players'), compact('teams'));  // Pass data to admin view
        } else {
            return view('home');  // Redirect non-admin users to home
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
