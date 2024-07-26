<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTask extends Model
{
    protected $fillable = [
        'festival_id',
        'client_id',
        'status',
        'scheduled_at',
    ];

    protected $dates = ['scheduled_at'];

    public function festival()
    {
        return $this->belongsTo(Festival::class, 'festival_id', 'festival_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'client_id');
    }
}