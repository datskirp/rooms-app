<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    protected $fillable = [
        'name',
        'open_at',
        'start_on',
        'close_on',
        'user_id',
    ];

    public function owner(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(RoomQuestion::class);
    }

    // TODO: Проверить работу метода
    public function participants(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, RoomUser::class, 'room_id', 'id', 'id', 'user_email');
    }
}
