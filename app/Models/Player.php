<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Player extends Model
{
    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }
}
