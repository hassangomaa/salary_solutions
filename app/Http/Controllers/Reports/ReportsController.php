<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;

class ReportsController extends Controller
{
    public function index(){
        $companyId = FacadesSession::get('companyId');
        $month=Carbon::now()->format('m');
        $year=Carbon::now()->format('Y');
        // return
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
                ])->get();
        $flag = 1;
        $date=Carbon::now()->format('Y-M');
        return view('reports.index',compact('followUps','flag','date'));
    }


}
