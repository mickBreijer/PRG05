<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Player::class, 'player_team')->where('substitution', 0);  // Get players not substituted
    }

    public function substitutedPlayers(): BelongsToMany
    {
        return $this->belongsToMany(Player::class, 'player_team')->where('substitution', 1);  // Get players who are substituted
    }

    public function user()
    {
        return $this->belongsTo(User::class);  // Define relationship to the user who owns the team
    }
}
