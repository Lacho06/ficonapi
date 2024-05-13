<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PayrollWorker>
 */
class PayrollWorkerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'salaryRate' => fake()->numberBetween(1000, 18000),
            'hours' => fake()->numberBetween(10, 180),
            'toCollect' => fake()->numberBetween(1000, 10000),
            'bonus' => fake()->numberBetween(10, 100),
            'pat' => 0,
            'earnedSalary' => fake()->numberBetween(1000, 10000),
            'salaryTax' => fake()->numberBetween(1000, 10000),
            'withHoldings' => fake()->numberBetween(1000, 10000),
            'paid' => fake()->numberBetween(1000, 10000),
        ];
    }
}
