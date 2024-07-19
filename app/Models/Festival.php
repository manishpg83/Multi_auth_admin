<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Festival extends Model
{
    use HasFactory;

    protected $table = 'festivals';
    protected $primaryKey = 'festival_id';

    protected $fillable = [
        'name',
        'date',
        'status',
        'email_scheduled',
        'subject_line',
        'email_body',
    ];

    public function userFestivals()
    {
        return $this->hasMany(UserFestival::class, 'festival_id', 'festival_id');
    }
    public function getStatusAttribute($value)
    {
        return ucfirst(strtolower($value));
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = ucfirst(strtolower($value));
    }
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($query) use ($term) {
            $query->where('name', 'like', '%' . $term . '%')
                ->orWhere('subject_line', 'like', '%' . $term . '%')
                ->orWhere('email_body', 'like', '%' . $term . '%');
        });
    }
}