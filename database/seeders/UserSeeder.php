<?php

namespace Database\Seeders;

use App\Models\Friend;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create($this->newModel([
            'username' => 'John',
            'display_name' => 'John Doe',
            'email' => 'john@mail.com'
        ]));

        User::create($this->newModel([
            'username' => 'Frank',
            'display_name' => 'Frank Smith',
            'email' => 'frank@mail.com'
        ]));

        User::factory(10)->create();

        $userCount = User::count();
        foreach (User::pluck('id') as $userId1) {
            foreach (User::pluck('id') as $userId2) {
                if (fake()->boolean(60)) continue;

                if ($userId1 === $userId2) {
                    $userId2 += -1 + (2 * (int) fake()->boolean());
                }

                $friend = Friend::firstOrCreate([
                    'being_followed_id' => $userId1,
                    'follower_id' => $userId2,
                ]);

                if ($friend->wasRecentlyCreated && fake()->boolean(33)) {
                    Friend::firstOrCreate([
                        'follower_id' => $userId1,
                        'being_followed_id' => $userId2,
                        'are_friends' => true,
                    ]);
                    $friend->are_friends = true;
                    $friend->save();
                }
            }
        }
    }

    private function newModel(array $newData) {
        return array_merge(resolve(UserFactory::class)->definition(), $newData);
    }
}
