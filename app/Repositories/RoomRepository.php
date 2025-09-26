<?php

namespace App\Repositories;

use App\Models\Room;
use App\Repositories\Interfaces\RoomRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

final class RoomRepository implements RoomRepositoryInterface
{
    /**
     * repository dependency injector
     */
    public function __construct(protected Room $model)
    {
    }

    public function find(): LengthAwarePaginator
    {
        return $this->model->query()->orderByDesc('capacity')->paginate(perPage: 5);
    }
}