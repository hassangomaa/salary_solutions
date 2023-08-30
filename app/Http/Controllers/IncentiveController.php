<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\FollowUp;
use App\Models\Incentives;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IncentiveController extends Controller
{

    public function index()
    {
        $companyId = Session::get('companyId');
        $company = Company::find($companyId);
        $currntMonth = ReportController::getCurrentMonth($company);

        $incentives = Incentives::with('employee')->whereHas('employee',function ($query) use($companyId){
            $query->where('company_id',$companyId);
        })
            ->where('month',$currntMonth)
            ->paginate(10);
        $flag = 1 ;
        return view('incentive.index',compact('flag','incentives'));
    }

    public function addIncentives(Request $request)
    {
//        return $request->all();
        $incentive = Incentives::find($request->incentive_id);
        $incentive->incentive = $request->incentive;
        $incentive->bonus = $request->bonus;
        $incentive->regularity = $request->regularity;
        $incentive->gift = $request->gift;

        $incentive->save();

    }

}
