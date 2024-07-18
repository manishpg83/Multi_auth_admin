<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTracking extends Model
{
    use HasFactory;

    protected $table = 'email_tracking';

    protected $fillable = [
        'user_id',
        'email',
        'tracking_id',
        'opened',
        'sent_at',
        'opened_at',
    ];

    protected $casts = [
        'opened' => 'boolean',
        'sent_at' => 'datetime',
        'opened_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}