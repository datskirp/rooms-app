<?php

namespace App\Http\Resources;

use App\Models\RoomUser;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'open_at' => $this->open_at,
            'start_on' => $this->start_on,
            'close_on' => $this->close_on,
            'user_id' => $this->user_id,
            'link' => $this->link,
            'active' => $this->active,
            'participants' => RoomUser::where('room_id', $this->id)->get(),
            'questions' => $this->questions,
        ];
    }
}
