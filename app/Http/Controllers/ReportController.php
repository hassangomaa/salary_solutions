<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Models\FollowUp;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public static function newMonth($companyId){
        $employees = Employee::where('company_id', $companyId)->select('id')->get();
        $company = Company::find($companyId);

        $newFollowUps = [];

        foreach ($employees as $employee) {
            $newFollowUp = [
                'month' => $company->current_month,
                'employee_id' => $employee->id,
                // Other attributes for FollowUp, if needed
            ];

            $newFollowUps[] = $newFollowUp;
        }

        FollowUp::insert($newFollowUps);

    }
}
