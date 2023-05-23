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
    public function ostan()
    {
        return $this->belongsTo(Ostan::class);
    }
    public function shahrestan()
    {
        return $this->belongsTo(Shahrestan::class);
    }

    public function mosque()
    {
        return $this->belongsTo(masjed::class,'mosque_id');
    }
    /*public function major()
    {
        return $this->belongsTo(Major::class);
    }*/
}
