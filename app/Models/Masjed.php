<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masjed extends Model
{
    use HasFactory;

    protected $table = "masjeds";

    protected $fillable = ["ostan","shahrestan","hoze","gender","masjed"];
}
