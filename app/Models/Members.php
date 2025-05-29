<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    /** @use HasFactory<\Database\Factories\MembersFactory> */
    use HasFactory;

    protected $fillable = [
        'username',
        'role',
        'guild_attribution',
        'battle_tier',
        'status',
        'permission',
        // 'contribution',
        // 'rage_count',
    ];
}
