<?php

namespace App\Repositories\Interfaces;

use App\Models\RoomReserve;
use Illuminate\Pagination\LengthAwarePaginator;

interface RoomRepositoryInterface
{
    /**
     * find paginated rooms
     *
     * @return LengthAwarePaginator
     */
    public function find(): LengthAwarePaginator;

    /**
     * reserve a room for specific user
     *
     * @param int $userId
     * @param int $roomId
     * @param int $capacity
     * @return RoomReserve
     * @throws
     */
    public function reserve(int $userId, int $roomId, int $capacity): RoomReserve|null;
}