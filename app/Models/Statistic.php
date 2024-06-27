<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    protected $table = 'statistics';
    protected $primaryKey = 'stat_id';

    protected $fillable = [
        'user_id',
        'total_clients',
        'total_emails_sent',
        'total_emails_opened',
        'total_emails_replied',
        'active_users',
        'inactive_users',
        'trial_users',
        'total_revenue',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
