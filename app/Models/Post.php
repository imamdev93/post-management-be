<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'external_id',
        'user_id',
        'title',
        'body',
        'category',
        'release_date',
        'last_synced_at'
    ];

    protected $casts = [
        'release_date' => 'date',
        'last_synced_at' => 'datetime'
    ];
}
