<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Azmoon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'negative_point',
        'start_time',
        'end_time',
        'randomic',
        'shamsi',
        'start_hour',
        'end_hour',
        'duration',
        'major_id'
    ];

    public function questionCount()
    {
        return Question::where('parent_azmoon', $this->id)->count();
    }

    public function questions()
    {
        return $this->hasMany(Question::class,'parent_azmoon');
    }
}
