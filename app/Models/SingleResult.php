<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Table;

class SingleResult extends Model
{
    use HasFactory;
    protected $table='single_result';
    protected $guarded=[];
    public function moarefs(){
        return $this->morphMany(Moaref::class,'moarefable');
    }
}
