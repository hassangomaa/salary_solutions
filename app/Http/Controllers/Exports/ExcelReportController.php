<?php

namespace App\Http\Controllers\Exports;

use App\Exports\AppositionExport;
use App\Exports\AttendanceExport;
use App\Exports\bounsExport;
use App\Exports\deductionaExport;
use App\Exports\ExpensesExport as ExportsExpensesExport;
use App\Exports\Exports\ExpensesExport;
use App\Exports\incentivesExport;
use App\Exports\ReportDataExport;
use App\Exports\safeTransactionsExport;
use App\Exports\salariesExport;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelReportController extends Controller
{

    public function salariesExport($month,$year,$date,$request, $trashed ){

        return Excel::download(new salariesExport($month,$year,$date, $request, $trashed)
            , 'salaries.xlsx');
    }


    public function attendanceExport($period,$month_name){

        return Excel::download(new AttendanceExport($period,$month_name), 'attendance.xlsx');
    }

    public function reportDataExport($month,$year,$month_name,$request,$trashed){

        return Excel::download(new ReportDataExport($month,$year,$month_name,$request,$trashed)
            , 'report.xlsx');
    }

    public function expensesExport($date , $request, $trashed){
        return Excel::download(new ExportsExpensesExport($date,$request,$trashed)
            ,'expenses.xlsx');
    }

    public function apposition($month,$year, $trahsed){
        return Excel::download(new AppositionExport($month,$year, $trahsed)
            ,'apposition.xlsx');
    }
    public function deduction($month,$year){
        return Excel::download(new deductionaExport($month,$year),'deduction.xlsx');
    }
    public function incentives($month,$year){
        return Excel::download(new incentivesExport($month,$year),'incentives.xlsx');
    }
    public function bouns($month,$year){
        return Excel::download(new bounsExport($month,$year),'bouns.xlsx');
    }
    public function safeTransactions($date,$safe_id){
        return Excel::download(new safeTransactionsExport($date,$safe_id),'safetransactions.xlsx');
    }
}
