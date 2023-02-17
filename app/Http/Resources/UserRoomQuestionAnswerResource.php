<?php

namespace App\Http\Resources;

use App\Models\RoomQuestion;
use App\Models\RoomUser;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRoomQuestionAnswerResource extends JsonResource
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
            'user_id' => $this->user_id,
            'room_question_id' => $this->room_question_id,
            'answer' => $this->answer,
            'question_id' => RoomQuestion::find($this->room_question_id)->question_id,
            'updated_at' => $this->updated_at,
        ];
    }
}
