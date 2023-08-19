<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

//        $factory->define(Employee::class, function (Faker\Generator $faker) {
            return [
                'name' => $this->faker->name,
                'position' => $this->faker->jobTitle,
                'daily_fare' => $this->faker->randomNumber(2),
                'debit' => $this->faker->randomNumber(3),
                'phone' => $this->faker->randomNumber(9),
                'address' => $this->faker->address,
                'company_id' => Company::inRandomOrder()->first()->id,

            ];

    }
}
