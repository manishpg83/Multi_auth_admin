<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFestival extends Model
{
    use HasFactory;

    protected $table = 'user_festivals';
    protected $primaryKey = 'user_festival_id';

    protected $fillable = [
        'user_id',
        'festival_id',
        'scheduled_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function festival()
    {
        return $this->belongsTo(Festival::class, 'festival_id', 'festival_id');
    }
}
