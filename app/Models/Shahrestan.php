<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shahrestan extends Model
{
    use HasFactory;

    protected $fillable = ["name","ostan","amar_code"];
    public $timestamps = false;
}
