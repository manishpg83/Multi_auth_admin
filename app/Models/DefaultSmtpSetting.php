<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultSmtpSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'mailer_type',
        'smtp_host',
        'smtp_port',
    ];
}

