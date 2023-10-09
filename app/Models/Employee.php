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

    public function getAttendanceStatus($date)
    {
        // Retrieve the attendance record for the given date
          $attendance = $this->attendances()->where('date', $date)->first();

        // If attendance record exists, return its status; otherwise, return null
        return   $attendance ? $attendance->status : null;
    }

    public function getAttendanceCountForMonth($year, $month)
    {
        // Calculate the first and last day of the month
        $firstDayOfMonth = "{$year}-{$month}-01";
        $lastDayOfMonth = "{$year}-{$month}-" . date('t', strtotime($firstDayOfMonth));

        // Retrieve the attendance records for the specified month where status is 1
        $attendanceCount = $this->attendances()
            ->whereBetween('date', [$firstDayOfMonth, $lastDayOfMonth])
            ->where('status', 1)
            ->count();

        return $attendanceCount;
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
