<?php

namespace Database\Factories;

use App\Models\User;
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
        $user = User::all()->random();

        while(count($user->categories()->getResults()) == 0) {
            $user = User::all()->random();
        }

        return [
            "category_id" => $user->categories()->getResults()->random(),
            "user_id" => $user,
            "title" => $this->faker->jobTitle(),
            "description" => $this->faker->text,
            "due_date" => $this->faker->dateTime(),
            "urgency" => $this->faker->numberBetween(1, 5),
            "is_done" => $this->faker->boolean()
        ];
    }
}
