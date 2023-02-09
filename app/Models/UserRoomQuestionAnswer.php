<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserRoomQuestionAnswer extends Model
{
    use HasFactory;

    protected $table = 'user_room_question_answers';

    protected $fillable = [
        'user_id',
        'room_question_id',
        'answer',
    ];

    public function question(): HasOne
    {
        return $this->hasOne(RoomQuestion::class, 'id', 'room_question_id');
    }
}
