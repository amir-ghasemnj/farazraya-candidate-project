<?php

namespace App\LogicLayer;

use App\LogicLayer\Contracts\BaseLogic;
use App\Repositories\Interfaces\RoomRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

final class RoomLogic extends BaseLogic
{
    public function __construct(protected RoomRepositoryInterface $roomRepository,
                                protected UserRepositoryInterface $userRepository)
    {
    }

    public function reserve(int $userId, int $roomId, int $capacity): Contracts\LogicResult
    {
        $user = $this->userRepository->findById($userId);
        if (!$user) {
            return $this->makeResult()->setMessage(__('errors.user.etc.404.message'))
                        ->setStatusCode(__('errors.user.etc.404.code'));
        }

        $reserve = $this->roomRepository->reserve($userId, $roomId, $capacity);
        if (!$reserve) {
            return $this->makeResult()
                        ->setMessage(__('errors.room.capacity.message'))
                        ->setStatusCode(__('errors.room.capacity.code'));
        }

        return $this->makeResult()
                    ->setMessage(__('messages.room.reserve.success'))
                    ->setData($reserve);
    }
}