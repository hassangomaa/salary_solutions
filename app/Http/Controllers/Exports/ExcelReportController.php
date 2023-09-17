<?php

namespace App\Http\Controllers\Exports;

use App\Exports\salariesExport;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelReportController extends Controller
{

    public function salariesExport(Request $request){
        $request->date;
        $month=Carbon::now()->format('m');
        $year=Carbon::now()->format('Y');

        return Excel::download(new salariesExport($month,$year,Carbon::now()->format('Y-M')), 'salaries.xlsx');
    }
}
