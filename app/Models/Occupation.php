<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'salary',
    ];

    public function workers(){
        return $this->hasMany(Worker::class);
    }
}
