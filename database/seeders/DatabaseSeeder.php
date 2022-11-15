<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function truncate(array $seeders) {
        $this->call($seeders, false, ['truncate' => true]);
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncate([
            UserSeeder::class,
            CommunitySeeder::class,
            PostSeeder::class,
        ]);
    }
}
