<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupResult extends Model
{
    use HasFactory;

    protected $table='group_result';
    protected $guarded=[];
    public function moarefs(){
        return $this->morphMany(Moaref::class,'moarefable');
    }
}
