<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'area_id'
    ];

    public function workers(){
        return $this->hasMany(Worker::class);
    }

    public function area(){
        return $this->belongsTo(Area::class);
    }
}
