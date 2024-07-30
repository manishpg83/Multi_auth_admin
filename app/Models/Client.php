<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'clients';
    protected $primaryKey = 'client_id';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'company_name',
        'status',
        'mail_status',
        'user_id'
    ];

    // In Client model
    public function users()
    {
        return $this->belongsToMany(User::class, 'client_user', 'client_id', 'user_id')
                    ->withPivot('is_subscribed')
                    ->withTimestamps();
    }

}