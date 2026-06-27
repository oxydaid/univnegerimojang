<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;

#[Guarded(['id'])]
class Donor extends Model
{
    protected function casts(): array
    {
        return [
            'donated_at' => 'datetime',
            'is_visible' => 'boolean',
            'amount' => 'float',
        ];
    }
}
