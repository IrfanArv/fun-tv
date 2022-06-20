<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Question extends Model
{
    use HasFactory, Notifiable, HasRoles;
    public function room(){
        return $this->belongsTo(Room::class);
    }
    public function question_details(){
        return $this->hasMany(Question_details::class);
    }
    protected $fillable = [
        'title', 'room_id', 'image', 'point', 'status', 'time', 'user_id','date_start','date_end'
    ];
}
