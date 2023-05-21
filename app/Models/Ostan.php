<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ostan extends Model
{
    use HasFactory;
    public static function ostanById($id){
        return Ostan::find($id);
    }
}
