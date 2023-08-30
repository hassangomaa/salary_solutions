<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Deduction;
use App\Models\Employee;
use App\Models\FollowUp;
use App\Models\Incentives;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{


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
