<?php

namespace App\Http\Controllers;

use App\Exports\ReportExport;
use App\Models\Company;
use App\Models\Deduction;
use App\Models\Employee;
use App\Models\FollowUp;
use App\Models\Incentives;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function clickToGenerateReport()
    {
        $companyId = Session::get('companyId');
        $company = Company::find($companyId);
        $this->calculateMonthlyReport($companyId, $company->current_month, $company->current_year);
        return back();
    }


    public function calculateMonthlyReport($companyId1,$month1,$year1)
    {
        //Get Follow Up for the currnt Month
        $month = $month1;
        $year = $year1;
        $companyId = $companyId1;

        //Get Follow Up table for this month
        $followUps = FollowUp::with('employee')
            ->whereHas('employee', function ($query) use ($companyId) {
            $query->where('company_id', $companyId);
        })
            ->where('month', $month)
            ->where('year', $year)
            ->get();

        $this->calculateWorkedDaysAndExtras($followUps);

        $this->calculateIncentives($companyId,$month,$year);

        $this->calculateDeductions($companyId,$month,$year);

        $this->calculateBorrows($companyId,$month,$year);

        $this->calculateTotalNetSalary($followUps,$companyId,$month);

        //Generate Excel file
        ExcelController::generateExcelFile($companyId,$month,$year);

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

    public function calculateIncentives($companyId, $month, $year)
    {
        $followUps = FollowUp::with(['employee.incentives' => function ($query)use($year,$month) {
            $query->where('year', $year)->where('month',$month);
        }])
            ->whereHas('employee', function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })
            ->where('month', $month)
            ->where('year', $year)
            ->get();
        foreach ($followUps as $followUp)
        {
            $incentives = $followUp->employee->incentives[0];
            $total = $incentives->incentive +
                    $incentives->bonus +
                $incentives->regularity +
                $incentives->gift ;
            $followUp->incentives = $total;
            $followUp->save();

        }
    }

    public function calculateDeductions($companyId,$month,$year){
        $followUps = FollowUp::with(['employee.deductions' => function ($query)use($year,$month) {
            $query->where('year', $year)->where('month',$month);
        }])
            ->whereHas('employee', function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })
            ->where('month', $month)
            ->where('year', $year)
            ->get();

        foreach ($followUps as $followUp)
        {
            $deductions = $followUp->employee->deductions[0];
            $total = $deductions->housing +
                $deductions->penalty +
                $deductions->absence ;
            $followUp->deductions  = $total;
            $followUp->save();
        }
    }

    public function calculateBorrows($companyId,$month,$year)
    {
        $followUps = FollowUp::with(['employee.borrows' => function ($query)use($year,$month) {
            $query->where('year', $year)->where('month',$month);
        }])
            ->whereHas('employee', function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })
            ->where('month', $month)
            ->where('year', $year)
            ->get();

       foreach ($followUps as $followUp)
       {
           $newBorrow = 0;
           foreach ($followUp->employee->borrows as $borrow)
           {
            $newBorrow += $borrow->amount;
           }

           $followUp->borrows = $newBorrow;
           $followUp->save();
       }

    }

    public function calculateTotalNetSalary($followUps,$companyId,$month){
        $company = Company::find($companyId);
        $totalPaidSalary = 0;
        foreach ($followUps as $followUp)
        {
            $totalEarned = $followUp->daily_wages_earned + $followUp->total_extras + $followUp->incentives;
            $totalDeducted = $followUp->borrows + $followUp->deductions ;
            $followUp->total_salary = $totalEarned ;
            $followUp->net_salary = $totalEarned - $totalDeducted;
            $followUp->save();

            $totalPaidSalary += $followUp->net_salary;

        }
        $company->credit -= $totalPaidSalary;
             $company->save();
             TransactionLogController::salariesLog($company,$totalPaidSalary,$month);
    }



    public static function newMonth($company)
    {
        $employees = Employee::where('company_id', $company->id)->select('id')->get();

        $currntMonth = $company->current_month;
        $currntYear = $company->current_year;

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



}
