<?php
namespace App\Services;

use Ramsey\Uuid\Uuid;

class PlayerService
{
    public function generateLink(): array
    {
        return [
            'link_id' => Uuid::uuid4()->toString(),
            'link_expires_at' => now()->addDays(7),
        ];
    }
}
