<?php

namespace Tests\Feature;

use App\Jobs\ReleaseExpiredReserves;
use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Date;
use Tests\TestCase;

class ReserveTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_reserve_oversell(): void
    {
        $user = User::factory()->create();
        $room = Room::factory()->create(['capacity' => 3]);
        $repo = $this->app->make(\App\Repositories\RoomRepository::class);

        // check oversell capacity
        $reserve = $repo->reserve($user->id, $room->id, 5);

        // should be null for overselling
        $this->assertNull($reserve);
    }

    public function test_reserve_empty_room(): void
    {
        $user = User::factory()->create();
        $room = Room::factory()->create(['capacity' => 3]);
        $repo = $this->app->make(\App\Repositories\RoomRepository::class);

        // check valid capacity
        $reserve = $repo->reserve($user->id, $room->id, 2);

        // should be not null for valid reserve
        $this->assertNotNull($reserve);

        // check capacity
        $this->assertEquals(1, $room->fresh()->capacity);
    }

    public function test_check_expire_reserve(): void
    {
        $now = now();
        Date::setTestNow($now);

        $user = User::factory()->create();
        $room = Room::factory()->create(['capacity' => 5]);
        $repo = $this->app->make(\App\Repositories\RoomRepository::class);

        // valid reserve
        $reserve = $repo->reserve($user->id, $room->id, 2);

        // change test time
        Date::setTestNow($now->copy()->addMinutes(5));

        // release expired reserves
        $repo->releaseExpiredReserves();

        // reserve should be inactive
        $this->assertEquals(false, $reserve->fresh()->is_active);

        // check room capacity is released or not
        $this->assertEquals(5, $room->fresh()->capacity);
    }

    public function test_check_expire_reserve_with_job(): void
    {
        $now = now();
        Date::setTestNow($now);

        $user = User::factory()->create();
        $room = Room::factory()->create(['capacity' => 5]);
        $repo = $this->app->make(\App\Repositories\RoomRepository::class);

        // valid reserve
        $reserve = $repo->reserve($user->id, $room->id, 2);

        // change test time
        Date::setTestNow($now->copy()->addMinutes(5));

        // release expired reserves
        dispatch_sync(new ReleaseExpiredReserves($repo));

        // reserve should be inactive
        $this->assertEquals(false, $reserve->fresh()->is_active);

        // check room capacity is released or not
        $this->assertEquals(5, $room->fresh()->capacity);
    }
}
