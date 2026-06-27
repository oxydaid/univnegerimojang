<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;

#[Guarded(['id'])]
class MinecraftServer extends Model
{
    protected function casts(): array
    {
        return [
            'ports' => 'array',
            'is_active' => 'boolean',
        ];
    }
}
