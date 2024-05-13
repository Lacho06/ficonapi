<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'prepayroll_id'
    ];

    public function payrollWorkers(){
        return $this->hasMany(PayrollWorker::class);
    }

    public function prepayroll(){
        return $this->belongsTo(PrePayroll::class);
    }
}
