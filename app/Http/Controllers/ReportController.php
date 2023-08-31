<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Deduction;
use App\Models\Employee;
use App\Models\FollowUp;
use App\Models\Incentives;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReportController extends Controller
{

    public function generateReport()
    {
        //Get Follow Up for the currnt Month
        $month = 8; //TODO: enhance this line to get the exact currnt month;
        $year = 2023; //TODO: enhance this line to get the exact currnt year;
        $companyId = Session::get('companyId');

        //Get Follow Up table for this month
        $followUps = FollowUp::with('employee')
            ->whereHas('employee', function ($query) use ($companyId) {
            $query->where('company_id', $companyId);
        })
            ->where('month', $month)
            ->where('year', $year)
            ->get();

        //Calculate Worked Days
        $this->calculateWorkedDaysAndExtras($followUps);
        $this->addIncentives($followUps,$companyId,$month,$year);


    }

    private function calculateWorkedDaysAndExtras($followUps)
    {
        foreach($followUps as $followUp)
        {
            $followUp->daily_wages_earned =  $followUp->attended_days * $followUp->employee->daily_fare;
            $followUp->total_extras =  $followUp->extra_hours * $followUp->employee->overtime_hour_fare;
            $followUp->save();

        }
    }

    public function addIncentives($followUps,$companyId,$month,$year)
    {
        $incentives =
            Incentives::with('employee')
            ->whereHas('employee', function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })
            ->where('month', $month)
            ->where('year', $year)
            ->get();
//        foreach ($followUps as $followUp)
//        {
////            $employee = $incentives['']
//        }
    }



    public static function newMonth($companyId)
    {
        $employees = Employee::where('company_id', $companyId)->select('id')->get();
        $company = Company::find($companyId);
        $currntMonth = ReportController::getCurrentMonth($company);
        $currntYear = ReportController::getCurrntYear($company);

        $newFollowUps = [];
        $newIncentives = [];
        $newDeductions = [];

        foreach ($employees as $employee) {
            $newFollowUp = [
                'month' => $currntMonth,
                'year' => $currntYear,
                'employee_id' => $employee->id,
            ];
            $newIncentive = [
                'month' => $currntMonth,
                'year' => $currntYear,
                'employee_id' => $employee->id,
            ];
            $newDeduction = [
                'month' => $currntMonth,
                'year' => $currntYear,
                'employee_id' => $employee->id,
            ];

            $newFollowUps[] = $newFollowUp;
            $newIncentives[] = $newIncentive;
            $newDeductions[] = $newDeduction;
        }

        FollowUp::insert($newFollowUps);
        Incentives::insert($newIncentives);
        Deduction::insert($newDeductions);

    }

    private static function getCurrntYear($company)
    {
        if (today()->month < 12) {
            return today()->year;
        } elseif (today()->month == 12 && $company->end_month <= today()->day) {
            return today()->year;

        }
        return ++today()->year;

    }

    public static function getCurrentMonth($company)
    {
        $day = Carbon::today()->day;
        $companyLastDay =(int)$company->end_month;
        $lastDayOfTheMonth =  Carbon::today()->endOfMonth()->day;
        $isSameMonth = $company->isSameMonth;
        if($isSameMonth == 1)
        {
            return Carbon::today()->month;
        }
        if($companyLastDay <= $day && $day <= $lastDayOfTheMonth)
        {
            return ++Carbon::today()->month;
        }else{
            return Carbon::today()->month;
        }
    }
}
