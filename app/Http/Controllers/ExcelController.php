<?php

namespace App\Http\Controllers;

use App\Exports\ReportExport;
use App\Models\Company;
use App\Models\ExcelDetail;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
        public function generateExcelFile($companyId,$month,$year)
        {
    $company = Company::find($companyId);
    $fileName = $company->name . '-' . $month . '-' . $year.'.xlsx';
            $file =  Excel::download(new ReportExport($companyId,$month,$year), $fileName);
            $filePath = Excel::store(new ReportExport($company, $month, $year), $storagePath, 'public');


        }

        public function downloadFile($companyId,$month,$year)
        {
            $file = ExcelDetail::where('company_id',$companyId)
                ->where('month',$month)
                ->where('year',$year)
                ->first();


            $filePath = public_path('storage/Excel/'.$file->file_name);

            return response()->download($filePath, $file->file_name, [], 'inline');

        }
}
