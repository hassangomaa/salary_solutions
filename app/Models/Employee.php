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

    public function commissions()
    {
        return $this->hasMany(Commission::class, 'employee_id');
    }
    public function deductions()
    {
        return $this->hasMany(Deduction::class, 'employee_id');
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }


}
