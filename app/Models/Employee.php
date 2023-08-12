<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['name', 'position', 'daily_fare', 'credit','address','phone'];

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'employee_id');
    }

    public function kpiDeductions()
    {
        return $this->hasMany(KpiDeduction::class, 'employee_id');
    }


}
