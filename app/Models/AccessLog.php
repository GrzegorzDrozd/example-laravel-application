<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    protected $fillable = [
        'login_ip',
        'user_id',
    ];
}
