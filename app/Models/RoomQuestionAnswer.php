<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomQuestionAnswer extends Model
{
    use HasFactory;

    protected $table = 'room_question_answers';

    protected $fillable = [
        'room_question_id',
        'answer',
    ];
}
