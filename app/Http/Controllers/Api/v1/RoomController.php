<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddRoomRequest;
use App\Models\Room;
use App\Services\RoomService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class RoomController extends ApiController
{
    public function __construct(private readonly RoomService $roomService)
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $rooms = Room::all();

        return response()->json(['data' => $rooms]);
    }

    // TODO: provide validation rules
    public function create(AddRoomRequest $request): JsonResponse
    {
        $roomResource = $this->roomService->createRoom(
            $request->post(),
        );
        return $this->successResponse(
            data: $roomResource->resolve(),
            code: Response::HTTP_CREATED,
        );

        try {



        } catch (NotFoundException $error) {
            return $this->clientErrorsResponse(
                message: $error->getMessage(),
                code: Response::HTTP_NOT_FOUND,
            );
        } catch (Exception $error) {
            return $this->serverErrorResponse();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function show(int $room_id): JsonResponse
    {
        $room = Room::where($room_id)->firstOrFail();

        return response()->json(['data' => $room]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        //
    }
}
