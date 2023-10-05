<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\Exports\ExcelReportController;
use App\Models\Borrow;
use App\Models\CompanyPayment;
use App\Models\Employee;
use App\Models\Safe\Safe;
use App\Models\Safe\SafeTransactions;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session ;

class ReportsController extends Controller
{

    public function index(Request $request){

        $company_id=session()->all()['companyId'];
        $date=(isset($request->date))?$request->date:Carbon::now();
        $month=Carbon::parse($date)->format('m');
        $year=Carbon::parse($date)->format('Y');
        $date=Carbon::parse($date)->format('Y-M');

        if(isset($request->action) && $request->action=='excel'){
            $excel=new ExcelReportController;
            return $excel->salariesExport($month,$year,$date);

        }
         $followUps =Employee::whereHas('followUps',function($s)use($request){
                    if((isset($request->from_days)&& $request->from_days != "") && isset($request->to_days)&& $request->to_days != "")
                    $s->where('attended_days','>=',$request->from_days)
                    ->where('attended_days','<=',$request->to_days);
                })->with([
                'followUps'=>function($q)use($month,$year,$request){
                            $q->where('month',$month)->where('year',$year);

                        },
                "deductions"=>function($dq)use($month,$year){
                    $dq->where('month',$month)->where('year',$year);
                },
                "incentives"=>function($qi)use($month,$year){
                    $qi->where('month',$month)->where('year',$year);
                },
                "employeeBorrowinng"=>function($qb)use($month,$year){
                    $qb->whereHas('date',function($subq)use($month,$year){

                        $subq->where('month',$month)->where('year',$year);
                    });
                },
                ])->where('company_id',$company_id)
             ->whereYear('created_at','<=',$year)
             ->whereMonth('created_at','<=',$month)
             ->withTrashed()->get();
        $flag = 1;
        $date=Carbon::now()->format('Y-M');
        return view('reports.salaries',compact('followUps','flag','date'));
    }

    public function attendance(Request $request){

        $company_id=session()->all()['companyId'];

        $date=(isset($request->date))?Carbon::parse($request->date)->format('Y-m'):Carbon::now()->format('Y-m');
        $to_date=(isset($request->date))?Carbon::parse($request->date)->addMonth()->format('Y-m'):Carbon::now()->addMonth()->format('Y-m');
        $from=$date.'-25';
        $to=$to_date.'-26';
        $period = CarbonPeriod::create($from,$to);
        $month_name=Carbon::parse($date)->format('Y-M');

        $companyId = Session::get('companyId');
        $date=(isset($request->date))?$request->date:Carbon::now();
        $month=Carbon::parse($date)->format('m');
        $year=Carbon::parse($date)->format('Y');
        $date=Carbon::parse($date)->format('Y-M');

        if(isset($request->action) && $request->action=='excel'){
            $excel=new ExcelReportController;
            return $excel->attendanceExport($period,$month_name);

        }
         $employees =Employee::where('company_id',$company_id)->get();

        $flag = 1;
        $date=Carbon::now()->format('Y-M');
        return view('reports.attendance',compact('employees','period','flag','date','month_name'));
    }



    public function report(Request $request){

        $company_id=session()->all()['companyId'];
        $date=(isset($request->date))?$request->date:Carbon::now();
        $month=Carbon::parse($date)->format('m');
        $year=Carbon::parse($date)->format('Y');
        $date_name=Carbon::parse($date)->format('Y-M');

        if(isset($request->action) && $request->action=='excel'){
            $excel=new ExcelReportController;
            return $excel->reportDataExport($month,$year,$date_name);

        }
         $followUps =Employee::with([
                'followUps'=>function($q)use($month,$year){
                            $q->where('month',$month)->where('year',$year);
                        },
                "deductions"=>function($dq)use($month,$year){
                    $dq->where('month',$month)->where('year',$year);
                },
                "incentives"=>function($qi)use($month,$year){
                    $qi->where('month',$month)->where('year',$year);
                },
                "employeeBorrowinng"=>function($qb)use($month,$year){
                    $qb->whereHas('date',function($subq)use($month,$year){

                        $subq->where('month',$month)->where('year',$year);
                    });
                },
                ])->where('company_id',$company_id)
             ->whereYear('created_at','<=',$year)
             ->whereMonth('created_at','<=',$month)
             ->withTrashed()->paginate(1);
                $followUps_count=Employee::where('company_id',$company_id)->count();
        $flag = 1;

        $date=Carbon::now()->format('Y-M');
        return view('reports.report',compact('followUps','flag','date_name','followUps_count'));
    }


    public function expenses(Request $request){
        $date=(isset($request->date))?$request->date:Carbon::now();
        if(isset($request->action) && $request->action=='excel'){
            $excel=new ExcelReportController;
            return $excel->expensesExport($date);

        }
        $expenses=CompanyPayment::whereBetween('created_at',[Carbon::parse($date)->startOfMonth(),Carbon::parse($date)->endOfMonth()])
        ->paginate(25);
        $flag = 1;

        $date=Carbon::now()->format('Y-M');
        return view('reports.expenses',compact('expenses','flag'));
    }

    public function apposition(Request $request){
        $company_id=session()->all()['companyId'];

        $date=(isset($request->date))?$request->date:Carbon::now();
        $month=Carbon::parse($date)->format('m');
        $year=Carbon::parse($date)->format('Y');
        $date_name=Carbon::parse($date)->format('Y-M');

        if(isset($request->action) && $request->action=='excel'){
            $excel=new ExcelReportController;
            return $excel->apposition($month,$year);

        }
         $employees=Employee::with([
            "borrows"=>function($q)use($month,$year){
                    $q->where('month',$month)->where('year',$year);
            },
            ])->where('company_id',$company_id)->whereYear('created_at','<=',$year)
             ->whereMonth('created_at','<=',$month)
             ->withTrashed()
             ->paginate(10);



        $flag = 1;

        return view('reports.apposition',compact('employees','flag'));
    }

    public function deduction(Request $request){
//        return $request->all();
        $company_id=session()->all()['companyId'];

        $date=(isset($request->date))?$request->date:Carbon::now();
        $month=Carbon::parse($date)->format('m');
        $year=Carbon::parse($date)->format('Y');
//        return [$month , $year];
        $date_name=Carbon::parse($date)->format('Y-M');

        if(isset($request->action) && $request->action=='excel'){
            $excel=new ExcelReportController;
            return $excel->deduction($month,$year);

        }
          $employees=Employee::with([
            "deductions"=>function($q)use($month,$year){
                    $q->where('month',$month)->where('year',$year);
            },
            ])->where('company_id',$company_id)->whereYear('created_at','<=',$year)
              ->whereMonth('created_at','<=',$month)
              ->withTrashed()
              ->paginate(10);

//        return $employees;

        $flag = 1;

        return view('reports.deductions',compact('employees','flag'));
    }
    public function incentives(Request $request){
        $company_id=session()->all()['companyId'];

        $date=(isset($request->date))?$request->date:Carbon::now();
        $month=Carbon::parse($date)->format('m');
        $year=Carbon::parse($date)->format('Y');
        $date_name=Carbon::parse($date)->format('Y-M');

        if(isset($request->action) && $request->action=='excel'){
            $excel=new ExcelReportController;
            return $excel->incentives($month,$year);

        }
          $employees=Employee::with([
            "incentives"=>function($q)use($month,$year){
                    $q->where('month',$month)->where('year',$year);
            },
            ])->where('company_id',$company_id)
              ->whereMonth('created_at','<=',$month)
              ->whereYear('created_at','<=',$year)
              ->withTrashed()->paginate(10);



        $flag = 1;

        return view('reports.incentives',compact('employees','flag'));
    }
    public function bouns(Request $request){
        $company_id=session()->all()['companyId'];

        $date=(isset($request->date))?$request->date:Carbon::now();
        $month=Carbon::parse($date)->format('m');
        $year=Carbon::parse($date)->format('Y');
        $date_name=Carbon::parse($date)->format('Y-M');

        if(isset($request->action) && $request->action=='excel'){
            $excel=new ExcelReportController;
            return $excel->bouns($month,$year);

        }
          $employees=Employee::with([
            "followUps"=>function($q)use($month,$year){
                    $q->where('month',$month)->where('year',$year);
            },
            ])->where('company_id',$company_id)
              ->whereYear('created_at','<=',$year)
              ->whereMonth('created_at','<=',$month)
              ->withTrashed()->paginate(10);



        $flag = 1;

        return view('reports.bouns',compact('employees','flag'));
    }

    public function safe_transactions(Request $request){


        $company_id=session()->all()['companyId'];
        $date=(isset($request->date))?$request->date:Carbon::now();


        if(isset($request->action) && $request->action=='excel'){
            $excel=new ExcelReportController;
            return $excel->safeTransactions($date,$request->safe_id);

        }
         $safes_trans=SafeTransactions::
            whereBetween('created_at',[Carbon::parse($date)->startOfMonth(),Carbon::parse($date)->endOfMonth()])
            ->with('safe')->where(function($q)use($request){
                if( (isset($request->safe_id))&& $request->safe_id != "")
                $q->where('safe_id',$request->safe_id);
            })->get();



        $flag = 1;
        $safes=Safe::all();
        return view('reports.safeTransactions',compact('safes','flag','safes_trans'));
    }

}
