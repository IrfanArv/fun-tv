<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class Room extends Model
{
    use HasFactory, Notifiable, HasRoles;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function question(){
        return $this->hasMany(Question::class);
    }

    protected $fillable = [
        'name', 'stream_key', 'status','user_id','image','desc'
    ];
}
