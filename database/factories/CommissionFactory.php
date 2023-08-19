<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CommissionFactory extends Factory
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
                        'amount' => $this->faker->numberBetween(100, 1000),
                        'reason' => $this->faker->sentence,
                        // Other fields and their corresponding fake data here
                    ];
    }
}
