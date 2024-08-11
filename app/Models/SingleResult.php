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
    public function ostan(){
        return $this->belongsTo(Ostan::class,);
    }

    public function shahrestan()
    {
        return $this->belongsTo(Shahrestan::class);
    }

    public function mosque()
    {
        return $this->belongsTo(Masjed::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class,'major');
    }
}
