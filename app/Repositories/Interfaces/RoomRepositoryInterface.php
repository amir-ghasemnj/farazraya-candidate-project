<?php

namespace App\Repositories\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface RoomRepositoryInterface
{
    /**
     * find paginated rooms
     *
     * @return LengthAwarePaginator
     */
    public function find(): LengthAwarePaginator;
}