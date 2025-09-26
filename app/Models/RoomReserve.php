<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomReserve extends Model
{
    protected $table = 'room_reserves';
    protected $guarded = [];

    // ----------------------
    // relations
    // ----------------------

    /**
     * return belonged room
     *
     * @return BelongsTo
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    /**
     * return belonged user
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // ----------------------
    // implementations
    // ----------------------
}
