<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

class AchievementFactory extends Factory {
    public function definition(): array {
        return [
            'name' => fake()->words(2, true),
            'description' => fake()->sentence(),
            'icon' => '⭐',
            'criteria' => fake()->sentence(),
        ];
    }
}