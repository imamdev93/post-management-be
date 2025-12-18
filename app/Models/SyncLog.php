<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SyncLog extends Model
{
    protected $fillable = [
        'synced_at',
        'records_synced',
        'status'
    ];

    protected $casts = [
        'synced_at' => 'datetime'
    ];
}
