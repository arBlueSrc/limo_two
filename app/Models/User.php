<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded=[];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $fillable = ["otp"];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function isOstaniAdmin(){
        return $this->role == 2;
    }

    public function isMosjedAdmin(){
        return $this->role == 3;
    }

    public function isShahrestanAdmin(){
        return $this->role == 4;
    }

    public function isSuperAdmin()
    {
        return $this->role == 1;
    }

    public function ostan(){
        return $this->belongsTo(Ostan::class,);
    }

    public function shahrestan()
    {
        return $this->belongsTo(Shahrestan::class);
    }

}
