<?php

namespace App\Models;

use App\Models\Traits\HasFormattedDate;
use Database\Factories\RoomFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory, HasFormattedDate;

    protected $table = 'rooms';
    protected $fillable = [
        'name',
        'capacity',
    ];

    // ----------------------
    // configurations
    // ----------------------

    /**
     * specified new factory
     *
     * @return Factory|RoomFactory
     */
    protected static function newFactory(): \Illuminate\Database\Eloquent\Factories\Factory|RoomFactory
    {
        return RoomFactory::new();
    }

    // ----------------------
    // relations
    // ----------------------

    // ----------------------
    // implementations
    // ----------------------

    /**
     * check a room has capacity
     *
     * @param int $capacity
     * @return bool
     */
    public function hasCapacity(int $capacity = 1): bool
    {
        return $this->capacity >= $capacity;
    }
}
