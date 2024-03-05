<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'user_id' => 1,
            'priority' => 'low',
            'category' => 'work',
            'recurring' => false,
            'interval' => null,
            'archived' => false,
            'completed' => false,
            'completed_at' => null,
            'due_date' => null,
            'deleted_at' => null,
        ];
    }
}
