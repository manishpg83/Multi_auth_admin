<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'clients';
    protected $primaryKey = 'client_id';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'company_name',
        'status',
        'mail_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}