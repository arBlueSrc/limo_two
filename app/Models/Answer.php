<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable=[
        'user_id',
        'azmoon_id',
        'question_id',
        'user_answer',
        'user_score'
    ];

    use HasFactory;
    /*public function is_tashrihi_question(){

    }*/
}
