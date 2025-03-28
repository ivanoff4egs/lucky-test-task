<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    protected $fillable = ['value', 'result', 'coins', 'player_id'];

    public function player(): belongsTo
    {
        return $this->belongsTo(Player::class);
    }
}
