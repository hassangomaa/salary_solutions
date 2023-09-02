<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class IncentivesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id' => Employee::inRandomOrder()->first()->id,
            'month' => 9,
            'year' => 2023,
            'incentive' => $this->faker->numberBetween(0, 1000),
            'bonus' => $this->faker->numberBetween(0, 500),
            'regularity' => $this->faker->numberBetween(0, 200),
            'gift' => $this->faker->numberBetween(0, 50),
        ];
    }
}
