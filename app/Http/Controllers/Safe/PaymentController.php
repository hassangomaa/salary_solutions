<?php

namespace App\Http\Controllers\Safe;

use App\Http\Controllers\Controller;
use App\Models\CompanyPayment;
use App\Models\Employee;
use App\Models\Safe\Safe;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __invoke(Request $request){
        $date=Carbon::now();

        // $date=$request->date;
        $month=Carbon::parse($date)->format('m');
        $year=Carbon::parse($date)->format('Y');
        $date=Carbon::parse($date)->format('Y-M');

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
                ])->get();

                $total=0;
                foreach($followUps as $item){

                    $salary=$item->daily_fare * $item->followUps->sum('attended_days');
                    $extra=$item->overtime_hour_fare * $item->followUps->sum('extra_hours');
                    $deductions=$item->deductions->sum('housing')+$item->deductions->sum('penalty')+$item->deductions->sum('absence');
                    $incentives=$item->incentives->sum('incentive')+$item->incentives->sum('bonus')+$item->incentives->sum('gift')+$item->incentives->sum('regularity');
                    $borrowing=$item->employeeBorrowinng->sum('amount');
                    $net=($salary+$extra+$incentives)-($deductions+$borrowing);
                    $total +=$net;
                }
                $reason="دفع مرتبات شهر $date المبلغ $total";
                $safes=Safe::all();
                $flag=1;
                $paymentTypes = CompanyPayment::paymentType();

                    return view('company-payments.create',compact('total','reason','flag','paymentTypes','safes'));

            }
}
