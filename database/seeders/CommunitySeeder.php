<?php

namespace Database\Seeders;

use App\Models\Community;
use App\Models\User;
use Database\Factories\CommunityFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userCount = User::count();
        for ($i=0; $i < count(CommunityFactory::names()); $i++) {
            $userId =  fake()->numberBetween(1, $userCount);
            Community::create($this->newModel([
                'owner_id' => $userId,
            ]));
        }
    }

    private function newModel(array $newData) {
        return array_merge(resolve(CommunityFactory::class)->definition(), $newData);
    }
}
