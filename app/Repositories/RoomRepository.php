<?php

namespace App\Repositories;

use App\Models\Room;
use App\Models\RoomReserve;
use App\Repositories\Interfaces\RoomRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

final class RoomRepository implements RoomRepositoryInterface
{
    /**
     * repository dependency injector
     */
    public function __construct(protected Room $model, protected RoomReserve $roomReserve)
    {
    }

    public function find(): LengthAwarePaginator
    {
        return $this->model->query()->orderByDesc('capacity')->paginate(perPage: 5);
    }

    public function reserve(int $userId, int $roomId, int $capacity): RoomReserve|null
    {
        DB::beginTransaction();

        // Pessimistic lock for prevent overselling
        $room = $this->model->query()
                            ->where('id', $roomId)
                            ->where('capacity', '>=', $capacity)
                            ->lockForUpdate()
                            ->first();

        // check null
        if (!$room) {
            DB::rollBack();
            return null;
        }

        // decrementing room capacity
        $room->decrement('capacity', abs($capacity));
        $reserve = $this->roomReserve->query()
                                     ->create([
                                         'room_id' => $roomId,
                                         'user_id' => $userId,
                                         'capacity' => $capacity,
                                         'expires_at' => now()->addMinutes(2),
                                     ]);
        DB::commit();

        return $reserve;
    }

    public function releaseExpiredReserves(): void
    {
        DB::beginTransaction();
        $this->roomReserve->query()
                          ->where('expires_at', '<', now())
                          ->where('is_active', true)
                          ->chunk(50, function ($reserves) {
                              foreach ($reserves as $reserve) {
                                  $reserve->room->increment('capacity', $reserve->capacity);
                                  $reserve->update(['is_active' => false]);
                              }
                          });
        DB::commit();
    }
}