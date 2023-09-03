<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\FollowUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ExtraHoursController extends Controller
{
    public function index()
    {
        $companyId = Session::get('companyId');
        $company = Company::find($companyId);
        $month = $company->current_month;
        $year = $company->current_year;

        $followUps = FollowUp::with('employee')->whereHas('employee',function ($query) use($companyId){
            $query->where('company_id',$companyId);
        })
            ->where('month',$month)
            ->where('year',$year)
            ->paginate(10);
        $flag = 1 ;
        return view('extra-hours.index',compact('flag','followUps'));
    }

    public function updateNumberOfHours(Request $request)
    {
        $followUp =FollowUp::find($request->follow_up_id);
        $followUp->extra_hours = $request->number_of_hours;
        $followUp->save();

    }
}
