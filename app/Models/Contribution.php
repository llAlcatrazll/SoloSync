<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'contribution',
        'rage_count',
        'week_count',
        'member_id',
    ];

    public function member()
    {
        return $this->belongsTo(Members::class, 'member_id');
    }
}
