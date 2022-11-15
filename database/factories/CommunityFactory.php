<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Community>
 */
class CommunityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = fake()->unique()->randomElement(static::names());
        return [
            'name' => $name,
            'url' => $name,
            'desc' => fake()->words(5, true),
            'avatar' => fake()->imageUrl(200, 200),
        ];
    }

    public static function names () {
        return [
            'CallOfDuty', 'News', 'Memes', 'Programming', 'Sports', 'Art', 'Fishing', 'Teenagers',
            'Gaming', 'Politics', 'Technology',
        ];
    }
}
