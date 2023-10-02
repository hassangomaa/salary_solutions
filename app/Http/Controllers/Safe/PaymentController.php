<?php

namespace App\Http\Controllers\Safe;

use App\Http\Controllers\Controller;
use App\Models\CompanyPayment;
use App\Models\Employee;
use App\Models\Safe\Safe;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;

class PaymentController extends Controller
{
    public function __invoke(Request $request){
        $date=Carbon::parse($request->month);
        // return session()->all();
// return session(['key' => 'companyId']);
$company_id=FacadesSession::get('companyId');

        $month=Carbon::parse($date)->format('m');
        $year=Carbon::parse($date)->format('Y');
        $date=Carbon::parse($date)->format('Y-M');

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
                ])->where('company_id',$company_id)->get();

                $total=0;
                foreach($followUps as $item){

                    $total +=($item->daily_fare * ($item->followUps ? (($item->followUps->first())?$item->followUps->first()->attended_days:0) : 0)) +((($item->overtime_hour_fare != 0)?$item->followUps->sum('extra_hours') *$item->overtime_hour_fare:0))+
                    ($item->incentives->sum('regularity')+$item->incentives->sum('incentive')+$item->incentives->sum('gift')+$item->incentives->sum('bonus')) -
                    ($item->deductions->sum('housing') + $item->deductions->sum('penalty') + $item->deductions->sum('absence')+($item->employeeBorrowinng->first() ? $item->employeeBorrowinng->first()->amount : 0) );
                }
                $reason="دفع مرتبات شهر $date المبلغ $total";
                $safes=Safe::all();
                $flag=1;
                $paymentTypes = CompanyPayment::paymentType();

                return view('company-payments.create',compact('total','reason','flag','paymentTypes','safes'));

            }
}
