<?php

namespace App\Models;

use App\Models\Plan;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    protected $guard = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'otp',
        'company_name',
        'designation',
        'logo',
        'website',
        'address',
        'skype',
        'telegram',
        'imo',
        'whatsapp',
        'active_social',
        'role',
        'plan_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function smtpSettings()
    {
        return $this->hasOne(UserSmtp::class, 'user_id', 'user_id');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Get all clients associated with the user.
     */
    public function clients()
    {
        return $this->belongsToMany(Client::class, 'client_user', 'user_id', 'client_id')
                    ->withPivot('is_subscribed')
                    ->withTimestamps();
    }

    /**
     * Get only the subscribed clients for the user.
     */
    public function subscribedClients()
    {
        return $this->belongsToMany(Client::class, 'client_user', 'user_id', 'client_id')
                    ->wherePivot('is_subscribed', true)
                    ->withTimestamps();
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }
}