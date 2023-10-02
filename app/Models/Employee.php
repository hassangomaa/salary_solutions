<?php

namespace App\Models;

use App\Models\Borrowing\employeeBorrowing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class   Employee extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['name', 'position', 'daily_fare', 'credit','address','company_id','phone','overtime_hour_fare'];

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

    public function followUps(){
        return $this->hasMany(FollowUp::class,'employee_id');
    }

    public function borrows(){
        return $this->hasMany(Borrow::class);
    }

    public function incentives()
    {
        return $this->hasMany(Incentives::class);
    }

    public function employeeBorrowinng(){
        return $this->hasMany(employeeBorrowing::class,'user_id');
    }


}
