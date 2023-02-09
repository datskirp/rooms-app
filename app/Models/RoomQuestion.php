<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

// TODO: Реализовать тип вопроса через Enum
class RoomQuestion extends Model
{
    use HasFactory;

    protected $table = 'room_questions';

    protected $fillable = [
        'room_id',
        'type',
        'question',
    ];

    public function answers(): HasMany
    {
        return $this->hasMany(RoomQuestionAnswer::class);
    }
}
