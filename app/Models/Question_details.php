<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Question_details extends Model
{
    use HasFactory, Notifiable, HasRoles;
    public function question(){
        return $this->belongsTo(Question::class);
    }
    protected $fillable = [
        'question_id', 'answer_choice', 'sort_no', 'is_correct'
    ];
}
