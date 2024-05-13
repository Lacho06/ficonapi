<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PrePayrollWorker>
 */
class PrePayrollWorkerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // para un mes de 30 dias, sin trabajar sabados y domingos
        $limitHoursPerMounth = 22 * 8;
        $hoursWorked = fake()->numberBetween(8, $limitHoursPerMounth);
        $hoursNotWorked = $limitHoursPerMounth - $hoursWorked;

        // $hoursWorked % 8 == 0
        // significa que se trabajaron las 8h exactas de los dias q fue
        if($hoursNotWorked == 0 || $hoursWorked % 8 == 0){
            $tardiness = 0;
            $hoursCertificate = 0;
            $hoursMaternityLicence = 0;
            $hoursResolution = 0;
            $hoursInterrupted = 0;
            $hoursExtra = 0;
            $vacationDays = 0;
        }else{
            // se reparten las horas q sobran entre tardanza, certif, etc
            $restHours = $hoursWorked % 8;
            $tardiness = fake()->numberBetween(0, $restHours);
            $hoursCertificate = fake()->numberBetween(0, $restHours - $tardiness);
            $hoursMaternityLicence = fake()->numberBetween(0, $restHours - $tardiness - $hoursCertificate);
            $hoursResolution = fake()->numberBetween(0, $restHours - $tardiness - $hoursCertificate - $hoursMaternityLicence);
            $hoursInterrupted = fake()->numberBetween(0, $restHours - $tardiness - $hoursCertificate - $hoursMaternityLicence - $hoursResolution);
            $hoursExtra = fake()->numberBetween(0, $restHours - $tardiness - $hoursCertificate - $hoursMaternityLicence - $hoursResolution - $hoursInterrupted);
            $vacationDays = fake()->numberBetween(0, $restHours - $tardiness - $hoursCertificate - $hoursMaternityLicence - $hoursResolution - $hoursInterrupted - $hoursExtra);
        }

        return [
            'hoursWorked' => $hoursWorked,
            'hoursNotWorked' => $hoursNotWorked,
            'tardiness' => $tardiness,
            'hoursCertificate' => $hoursCertificate,
            'hoursMaternityLicence' => $hoursMaternityLicence,
            'hoursResolution' => $hoursResolution,
            'hoursInterrupted' => $hoursInterrupted,
            'hoursExtra' => $hoursExtra,
            'anotherTpoPay' => 0,
            'vacationDays' => $vacationDays
        ];
    }
}
