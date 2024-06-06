<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'buildedBy',
        'reviewBy',
        'approvedBy',
        'doneBy',
        'prepayroll_id',
    ];

    public function buildedByUser(){
        return $this->belongsTo(User::class, 'buildedBy');
    }

    public function reviewByUser(){
        return $this->belongsTo(User::class, 'reviewBy');
    }

    public function approvedByUser(){
        return $this->belongsTo(User::class, 'approvedBy');
    }

    public function doneByUser(){
        return $this->belongsTo(User::class, 'doneBy');
    }

    public function payrollWorkers(){
        return $this->hasMany(PayrollWorker::class);
    }

    public function prepayroll(){
        return $this->belongsTo(PrePayroll::class);
    }
}
