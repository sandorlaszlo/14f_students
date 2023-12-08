<?php

namespace Database\Factories;

use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $groups = Group::all();

        return [
            "name" => $this->faker->name,
            "email"=> $this->faker->safeEmail,
            "rank"=> $this->faker->numberBetween(1,100),
            "group_id"=> $groups->random(),
        ];
    }
}
