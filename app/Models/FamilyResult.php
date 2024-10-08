<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyResult extends Model
{
    use HasFactory;
    protected $table='family_result';
    protected $guarded=[];
    public function moarefs(){
        return $this->morphMany(Moaref::class,'moarefable');
    }
    public function ostan(){
        return $this->belongsTo(Ostan::class);
    }
    public function shahrestan(){
        return $this->belongsTo(Shahrestan::class);
    }
    public function mosque(){
        return $this->belongsTo(Masjed::class);
}
public function childs(){
        return $this->hasMany(FamilyResultChildren::class);
}
}
