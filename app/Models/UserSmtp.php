<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSmtp extends Model
{
    use HasFactory;
    protected $table = 'user_smtp'; // Ensure table name matches exactly

    protected $fillable = [
        'user_id',
        'smtp_host',
        'smtp_username',
        'smtp_password',
        'smtp_port',
        'smtp_from_name',
        'smtp_from_email',
        'mailer_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}