<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DeductionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id' => Employee::all()->random()->id,
            'month' => 9,
            'year' => 2023,
            'absence' => $this->faker->numberBetween(100, 1000),
            'penalty' => $this->faker->numberBetween(100, 1000),
            'housing' => $this->faker->numberBetween(100, 1000),
            // Other fields and their corresponding fake data here
        ];
    }
}
