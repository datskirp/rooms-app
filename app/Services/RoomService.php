<?php

declare(strict_types=1);

namespace App\Services;

use App\Events\ParticipantJoined;
use App\Events\UserAnswerSubmitted;
use App\Exceptions\NotFoundException;
use App\Http\Resources\RoomResource;
use App\Http\Resources\UserRoomQuestionAnswerResource;
use App\Models\ActiveRoom;
use App\Models\Room;
use App\Models\RoomQuestion;
use App\Models\RoomUser;
use App\Models\User;
use App\Models\UserRoomQuestionAnswer;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoomService
{
    // TODO: send email to participants about room creation
    public function createRoom(array $roomData): RoomResource
    {
        $room = Room::create([
            'name' => $roomData['name'],
            'open_at' => $roomData['open_at'],
            'start_on' => $roomData['start_on'],
            'close_on' => $roomData['close_on'],
            'user_id' => $roomData['creator_id'],
            'link' => uniqid(),
            'active' => 0,
        ]);

        $this->createRoomUsers($roomData['users'], $room->id);
        $questionIds = $this->createQuestions($roomData['questions']);

        $room->questions()->attach($questionIds);

        return new RoomResource($room);
    }

    private function createRoomUsers(array $users, int $id): void
    {
        foreach ($users as $user) {
            RoomUser::insert([
                'user_email' => $user,
                'room_id' => $id,
                'active' => false,
            ]);
        }
    }

    private function createQuestions(array $questions): array
    {
        $questionIds = [];
        foreach ($questions as $question) {
            $questionIds[] = DB::table('questions')->insertGetId($question);
        }

        return $questionIds;
    }

    public function getRoomByLink(string $link, string $userEmail): RoomResource
    {
        $room = Room::where('link', $link)->where('active', 1)->first();
        //$roomUser = RoomUser::where('user_email', auth()->user()->email)->first();

        if (!$room) {
            throw new NotFoundException(
                sprintf('Room is not found'),
            );
        }
        $roomUser = RoomUser::where('user_email', $userEmail)->where('room_id', $room->id)->first();
        $roomUser->active = true;
        $roomUser->timestamps = false;
        $roomUser->save();

        broadcast(new ParticipantJoined(RoomUser::all()->toArray()));

        return new RoomResource($room);
    }

    public function saveAnswer(array $answer): UserRoomQuestionAnswerResource
    {
        $roomQuestionId = RoomQuestion::where('room_id', $answer['room_id'])
            ->where('question_id', $answer['question_id'])
            ->first();

        $userRoomQuestionAnswer = UserRoomQuestionAnswer::create([
            'user_id' => $answer['user_id'],
            'room_question_id' => $roomQuestionId->id,
            'answer' => $answer['answer'],
        ]);

        DB::table('active_rooms')->insert([
            'room_id' => $answer['room_id'],
            'user_id' => $answer['user_id'],
            'question_id' => $answer['question_id'],
            'answer' => true,
        ]);

        $activeRoom = ActiveRoom::where('room_id', $answer['room_id'])
            ->where('question_id', $answer['question_id'])
            ->get();
        
        broadcast(new UserAnswerSubmitted($activeRoom->toArray()));

        return new UserRoomQuestionAnswerResource($userRoomQuestionAnswer);
    }
}


