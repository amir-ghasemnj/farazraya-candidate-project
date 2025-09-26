<?php

namespace App\Http\Controllers;

use App\Http\Requests\Room\RoomReserveRequest;
use App\LogicLayer\RoomLogic;
use App\Repositories\RoomRepository;
use App\Utils\ResponseUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    /**
     * show a paginated list of rooms
     *
     * @param RoomRepository $repository
     * @return JsonResponse
     */
    public function index(RoomRepository $repository): \Illuminate\Http\JsonResponse
    {
        $rooms = $repository->find();
        return ResponseUtil::factory(data: [
            'rooms' => $rooms->items(),
            'pagination' => formatPagination($rooms)
        ], renderData: true);
    }

    /**
     * reserve a room
     *
     * @param RoomReserveRequest $request
     * @param RoomLogic $roomLogic
     * @return JsonResponse
     */
    public function reserve(RoomReserveRequest $request, RoomLogic $roomLogic): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validated();
        $result = $roomLogic->reserve(
            Auth::id(),
            $validated['room_id'],
            $validated['capacity'],
        );
        return ResponseUtil::fromLogicResult($result, true);
    }
}
