<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Occupation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Worker>
 */
class WorkerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ci = fake()->randomNumber(9, true).fake()->randomNumber(2, true);
        $code = $ci % 100000;


        return [
            'code' => $code,
            'name' => fake()->name(),
            'ci' => $ci,
            'category' => fake()->randomElement(['ingeniero', 'master', 'doctor']),
            'occupation_id' => Occupation::all()->random()->id,
            'department_id' => Department::all()->random()->id,
        ];
    }
}
