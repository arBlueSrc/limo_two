<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAzmoon extends Model
{
    use HasFactory;

    protected $table = "log_azmoon_user";

    protected $fillable = [
        'user_id',
        'start_time',
        'azmoon_id'
    ];
}
