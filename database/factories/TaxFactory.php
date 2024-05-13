<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tax>
 */
class TaxFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $minValue = fake()->randomNumber(1, true);
        do{
            $maxValue = fake()->randomNumber(1, true);
        }while($minValue >= $maxValue && $minValue != 9);

        if($minValue == 9){
            $maxValue = $maxValue.'0';
        }

        return [
            'type' => fake()->randomElement(['seguridad social', 'ingresos personales']),
            'minValue' => $minValue == 0 ? 0 : $minValue.'000',
            'maxValue' => $maxValue == 0 ? 0 : $maxValue.'000',
            'percentage' => fake()->numberBetween(0, 100),
        ];
    }
}
