<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'type',
        'option_1',
        'option_2',
        'option_3',
        'option_4',
        'answer',
        'parent_azmoon',
        'tashrihi_answer'
    ];
    public function is_tashrihi_question()
    {
        return $this->type;
    }
    public function is_testi_question(){
        return $this->type == 0;
    }
}
