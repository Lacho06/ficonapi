<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrePayrollWorker extends Model
{
    use HasFactory;

    protected $fillable = [
        'hoursWorked',
        'hoursNotWorked',
        'tardiness',
        'hoursCertificate',
        'hoursMaternityLicence',
        'hoursResolution',
        'hoursInterrupted',
        'hoursExtra',
        'anotherTpoPay',
        'vacationDays',
        'prepayroll_id',
        'worker_id',
    ];

    public function payrollWorker(){
        return $this->hasOne(PayrollWorker::class, 'prepayrollworker_id');
    }

    public function prepayroll(){
        return $this->belongsTo(PrePayroll::class, 'prepayroll_id');
    }

    public function worker(){
        return $this->belongsTo(Worker::class, 'worker_id');
    }
}
