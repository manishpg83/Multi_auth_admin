<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ClientUser extends Pivot
{
    protected $table = 'client_user';

    // Allow mass assignment for these fields
    protected $fillable = [
        'client_id',
        'user_id',
        'is_subscribed'
    ];

    // Cast boolean field
    protected $casts = [
        'is_subscribed' => 'boolean',
    ];

    // Relationship to Client
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}