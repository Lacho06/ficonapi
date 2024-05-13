<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrePayroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'month',
        'year',
    ];

    public function prepayrollWorker(){
        return $this->hasMany(PrePayrollWorker::class, 'prepayroll_id');
    }

    public function payroll(){
        return $this->hasOne(Payroll::class);
    }
}
