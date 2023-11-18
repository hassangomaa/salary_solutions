<?php

namespace App\Models;

use App\Models\Borrowing\employeeBorrowing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class  Employee extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name', 'position', 'daily_fare', 'credit','address','company_id','phone','overtime_hour_fare'
    ,'deleted_at','created_at','updated_at'
    ];





    public function getTotalAttendedDaysForMonth($year, $month)
    {
        // Retrieve the company associated with the employee
        $company = $this->company;

        if (!$company) {
            return 0; // Handle the case where the employee is not associated with a company
        }
        $company = $this->company;

        if (!$company) {
            return 0; // Handle the case where the employee is not associated with a company
        }

        // Determine the start and end days of the salary policy month
        $startDay = $company->start_month;
        $endDay = $company->end_month;


        // Calculate the start date of the salary policy period (25th of the previous month)
//        $startDate = Carbon::create($year, $month, 25)->subMonth();
        $startDate = Carbon::create($year, $month, $startDay);

        // Calculate the end date of the salary policy period (26th of the current month)
//        $endDate = Carbon::create($year, $month, 26);

        $endDate = Carbon::create($year, $month, $endDay)->addMonth();

        // Retrieve the attendance records for the specified month and year
        $attendedDays = $this->attendances()
            ->whereBetween('date', [$startDate, $endDate])
            ->where('status', 1)
            ->count();

        return $attendedDays;
    }


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
    //setAttendanceTozero
    public function setAttendanceToZero($year, $month)
    {
        // Retrieve the company associated with the employee
        $company = $this->company;

        if (!$company) {
            return null; // Handle the case where the employee is not associated with a company
        }

        // Determine the start and end days of the salary policy month
        $startDay = $company->start_month;
        $endDay = $company->end_month;

        // Calculate the start date of the salary policy period
        $startDate = Carbon::create($year, $month, $startDay);

        // Calculate the end date of the salary policy period
        $endDate = Carbon::create($year, $month, $endDay)->addMonth();

        // Retrieve the attendance records for the given year and month within the salary policy period
        $attendances = $this->attendances()
            ->whereBetween('date', [$startDate, $endDate])
            ->get();

        // Update the attendance records to set the status to 0
        $attendances->each(function ($attendance) {
            $attendance->update(['status' => 0]);
        });

        return $attendances;
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

    //deductions only trashed
    public function deductionsOnlyTrashed()
    {
        return $this->hasMany(Deduction::class, 'employee_id')->onlyTrashed();
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
