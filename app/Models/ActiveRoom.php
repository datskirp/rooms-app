<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveRoom extends Model
{
    use HasFactory;

    protected $table = 'active_rooms';

    protected $fillable = [
        'room_id',
        'user_id',
        'question_id',
        'answer',
    ];
}
