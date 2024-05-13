<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'ci',
        'category',
        'occupation_id',
        'department_id',
    ];

    public function occupation(){
        return $this->belongsTo(Occupation::class);
    }
    public function department(){
        return $this->belongsTo(Department::class);
    }
    public function prepayrollWorker(){
        return $this->hasMany(PrePayroll::class);
    }
}
