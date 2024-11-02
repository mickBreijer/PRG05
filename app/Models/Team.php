<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Player::class, 'player_team')->where('substitution', 0);
    }

    public function substitutedPlayers(): BelongsToMany
    {
        return $this->belongsToMany(Player::class, 'player_team')->where('substitution', 1);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
