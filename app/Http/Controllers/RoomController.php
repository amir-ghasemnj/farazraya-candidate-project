<?php

namespace App\Http\Controllers;

use App\Repositories\RoomRepository;
use App\Utils\ResponseUtil;

class RoomController extends Controller
{
    public function index(RoomRepository $repository): \Illuminate\Http\JsonResponse
    {
        $rooms = $repository->find();
        return ResponseUtil::factory(data: [
            'rooms' => $rooms->items(),
            'pagination' => formatPagination($rooms)
        ], renderData: true);
    }
}
