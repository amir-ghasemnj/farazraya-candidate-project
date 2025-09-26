<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // allow truncating
        DB::table('room_reserves')->truncate();

        // seeding
        $this->call([
            UserSeeder::class,
            RoomSeeder::class,
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // allow foreign key checks
    }
}
