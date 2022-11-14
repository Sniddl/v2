<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Timeline;
use App\Models\User;
use Database\Factories\PostFactory;
use Database\Factories\TimelineFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userCount = User::count();
        for ($i=0; $i < 100; $i++) {
            $userId =  fake()->numberBetween(1, $userCount);
            $post = Post::create($this->newModel(PostFactory::class, [
                'user_id' => $userId,
            ]));
            Timeline::create($this->newModel(TimelineFactory::class, [
                'post_id' => $post->id,
                'added_by' => $userId,
            ]));
        }

        // Timeline::factory(10)->for()
    }

    private function newModel($model, array $newData) {
        return array_merge(resolve($model)->definition(), $newData);
    }
}
