<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrow>
 */
class BorrowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
          return [
              'employee_id' => Employee::inRandomOrder()->first()->id, // Get a random employee's ID
              'month' => $this->faker->numberBetween(1, 12),
              'amount' => $this->faker->numberBetween(100, 1000),
              'statement' => $this->faker->sentence,
        ];
    }
}
