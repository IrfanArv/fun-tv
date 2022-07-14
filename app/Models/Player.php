<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticable;
use Laravel\Sanctum\HasApiTokens;



class Player extends Authenticable
{
    use Notifiable, HasApiTokens;

    protected $guard = 'players';

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function chat(){
        return $this->hasMany(Chat::class);
    }
    protected $fillable = [
        'name', 'email', 'password','phone','otp','username','image','bio','gender','brith'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
