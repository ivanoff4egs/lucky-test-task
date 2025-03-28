<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Player extends Model
{
    protected $fillable = ['username', 'phone_number', 'link_id', 'link_expires_at'];

    public function getLinkAttribute(): string
    {
        return sprintf('%s/%s', env('APP_URL'), $this->link_id);
    }

    public function getIsLinkExpiredAttribute(): bool
    {
        return $this->link_expires_at <= now();
    }

    protected function casts(): array
    {
        return [
            'link_expires_at' => 'datetime'
        ];
    }

    public function games(): hasMany
    {
        return $this->hasMany(Game::class);
    }
}
