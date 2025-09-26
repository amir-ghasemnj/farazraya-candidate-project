<?php

namespace App\Jobs;

use App\Repositories\Interfaces\RoomRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ReleaseExpiredReserves implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected RoomRepositoryInterface $roomRepository)
    {
        $this->handle();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->roomRepository->releaseExpiredReserves();
    }
}
