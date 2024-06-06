<?php

namespace Tests\Feature;

use App\Models\Payroll;
use App\Models\PrePayroll;
use Tests\TestCase;

class PayrollTest extends TestCase
{
    /** @test */
    public function it_can_create_payroll(): void
    {
        $this->assertCount(0, Payroll::all());
        $prePayroll = PrePayroll::create([
            'month' => 'Enero',
            'year' => 2020,
        ]);
        $prePayrolls = PrePayroll::all();
        $this->assertNotEmpty($prePayrolls);
        $payroll = Payroll::create([
            'prepayroll_id' => $prePayroll->id,
        ]);
        $this->assertCount(1, Payroll::all());
        $payroll->delete();
        $prePayroll->delete();
    }

    /** @test */
    public function it_can_show_list_payroll(){
        $this->assertCount(0, Payroll::all());

        $prePayroll1 = PrePayroll::create([
            'month' => 'Enero',
            'year' => 2020
        ]);

        $payroll1 = Payroll::create([
            'prepayroll_id' => $prePayroll1->id
        ]);


        $prePayroll2 = PrePayroll::create([
            'month' => 'Febrero',
            'year' => 2020
        ]);

        $payroll2 = Payroll::create([
            'prepayroll_id' => $prePayroll2->id
        ]);


        $prePayroll3 = PrePayroll::create([
            'month' => 'Marzo',
            'year' => 2020
        ]);

        $payroll3 = Payroll::create([
            'prepayroll_id' => $prePayroll3->id
        ]);

        $payrollsArray = [];
        array_push($payrollsArray, $payroll1);
        array_push($payrollsArray, $payroll2);
        array_push($payrollsArray, $payroll3);

        $results = Payroll::all();
        $this->assertCount(3, $results);
        $i = 0;
        foreach($results as $result){
            $this->assertEquals($result->id, $payrollsArray[$i]->id);
            $i++;
        }
        $payroll1->delete();
        $payroll2->delete();
        $payroll3->delete();
        $prePayroll1->delete();
        $prePayroll2->delete();
        $prePayroll3->delete();
    }
}
