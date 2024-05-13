<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Area;
use App\Models\Department;
use App\Models\Occupation;
use App\Models\Payroll;
use App\Models\PayrollWorker;
use App\Models\PrePayroll;
use App\Models\PrePayrollWorker;
use App\Models\Tax;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $occupations = ['tecnico general', 'asesor juridico', 'jefe de seccion tecnica', 'asesor legal'];
        $departments = ['jefe tecnico', 'comercial', 'informatica', 'seguridad y proteccion'];
        $areas = ['direccion general', 'informatica', 'seguridad'];
        User::factory(10)->create();
        foreach($occupations as $occupation){
            Occupation::factory(1)->create([
                'name' => $occupation
            ]);
        }
        foreach($areas as $area){
            Area::factory(1)->create([
                'name' => $area
            ]);
        }
        foreach($departments as $department){
            Department::factory(1)->create([
                'name' => $department
            ]);
        }
        Worker::factory(30)->create();
        Tax::factory(10)->create();

        PrePayroll::factory(1)->create()->each(function ($prepayroll){
            for($i = 1; $i <= 30; $i++){
                PrePayrollWorker::factory(1)->create([
                    'prepayroll_id' => $prepayroll->id,
                    'worker_id' => Worker::find($i)->id
                ]);
            }

            Payroll::factory(1)->create([
                'prepayroll_id' => $prepayroll->id
            ])->each(function ($payroll){
                for($i = 1; $i <= 30; $i++){
                    PayrollWorker::factory(1)->create([
                        'payroll_id' => $payroll->id,
                        'prepayrollworker_id' => PrePayrollWorker::find($i)->id
                    ]);
                }
            });
        });
    }
}
