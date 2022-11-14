<?php

namespace Database\Seeders;

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
            'username' => 'John Doe',
            'display_name' => 'John',
            'email' => 'john@mail.com'
        ]));

        User::create($this->newModel([
            'username' => 'Frank Smith',
            'display_name' => 'Frank',
            'email' => 'frank@mail.com'
        ]));

        User::factory(10)->create();
    }

    private function newModel(array $newData) {
        return array_merge(resolve(UserFactory::class)->definition(), $newData);
    }
}
