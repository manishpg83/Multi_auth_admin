<?php

namespace App\Models;

use App\Models\UserFestival;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Festival extends Model
{
    use HasFactory;
    use SoftDeletes;


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