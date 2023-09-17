<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\FollowUp;
use App\Models\Incentives;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IncentiveController extends Controller
{

    public function index()
    {
        $companyId = Session::get('companyId');
        $company = Company::find($companyId);
        $currntMonth = $company->current_month;

        $incentives = Incentives::with('employee')->whereHas('employee',function ($query) use($companyId){
            $query->where('company_id',$companyId);
        })
            // ->where('month',$currntMonth)
            ->where('status',FollowUp::USE)

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

    public function refreshData(){
        $employee_ids=Incentives::select('employee_id')->distinct('employee_id')->pluck('employee_id');
        $deduction_ids=Incentives::where('month',Carbon::now()->format('m'))->where('year',Carbon::now()->format('Y'))->get()->keyBy('employee_id');

        foreach($employee_ids as $item){
            if(isset($deduction_ids[$item])){
                continue;
            }
            Incentives::where('employee_id',$item)->latest()->first()->update([
                'status'=>FollowUp::DONE
            ]);

            Incentives::create([
                'month'=>Carbon::now()->format('m'),
                'year'=>Carbon::now()->format('Y'),
                'incentive'=>0,
                'bonus'=>0,
                'regularity'=>0,
                'gift'=>0,
                'employee_id'=>$item,
                'status'=>FollowUp::USE
        ]);
    }
return redirect()->back()->with('message',"Successfull");

}
}
