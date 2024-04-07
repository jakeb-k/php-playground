<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'task' => $this->faker->sentence(),
            'priority'=> $this->faker->numberBetween(1,3),
            'due_date' => $this->faker->dateTime(),
            'user_id'=> $this->faker->numberBetween(1,2),
        ];
    }
}
