<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class LogPlayer extends Model
{
    use HasFactory, Notifiable;

    public function player(){
        return $this->belongsTo(Player::class);
    }

    protected $fillable = [
        'player_id'
    ];
}
