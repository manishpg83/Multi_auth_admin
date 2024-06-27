<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailAccount extends Model
{
    use HasFactory;

    protected $table = 'email_accounts';
    protected $primaryKey = 'email_account_id';

    protected $fillable = [
        'user_id',
        'email_type',
        'email_address',
        'signature',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
