<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollWorker extends Model
{
    use HasFactory;

    protected $fillable = [
        'salaryRate',
        'hours',
        'toCollect',
        'bonus',
        'pat',
        'earnedSalary',
        'salaryTax',
        'withHoldings',
        'paid',
        'payroll_id',
        'prepayrollworker_id',
    ];

    public function payroll(){
        return $this->belongsTo(Payroll::class);
    }

    public function prepayrollWorker(){
        return $this->belongsTo(PrePayrollWorker::class, 'prepayrollworker_id');
    }
}
