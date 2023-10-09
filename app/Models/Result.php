<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'azmoon_id',
        'true_answer',
        'wrong_answer',
        'empty_answer',
        'percent',
    ];

    public function single_result(){
        return $this->hasOne(SingleResult::class, 'id', 'user_id');
    }

    public function azmoon()
    {
        return $this->belongsTo(Azmoon::class);
    }
}
