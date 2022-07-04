<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Answers extends Model
{
    use HasFactory, Notifiable, HasRoles;

    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function answer(){
        return $this->belongsTo(Question_details::class);
    }
    public function player(){
        return $this->belongsTo(Player::class);
    }

    protected $fillable = [
        'player_id', 'question_id', 'answer_id','corrected'
    ];
}
