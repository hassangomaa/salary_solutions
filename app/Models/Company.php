<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes; // Use SoftDeletes trait

    protected $fillable = ['name','credit','address','phone',];
    protected $dates = ['deleted_at']; // Add 'deleted_at' to dates array

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
