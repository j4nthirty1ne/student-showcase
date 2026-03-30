<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    const UPDATED_AT = null; // No updated_at column

    protected $fillable = [
        'admin_id',
        'action_type',
        'target_table',
        'target_id',
        'note',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
