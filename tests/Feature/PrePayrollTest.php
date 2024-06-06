<?php

namespace Tests\Feature;

use App\Models\PrePayroll;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PrePayrollTest extends TestCase
{
    /** @test */
    public function it_can_create_prepayroll(): void
    {
        $this->assertCount(0, PrePayroll::all());
        $prePayroll = PrePayroll::create([
            'month' => 'Enero',
            'year' => 2020,
        ]);
        $this->assertCount(1, PrePayroll::all());
        $prePayroll->delete();
    }
}
