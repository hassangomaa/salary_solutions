<?php

namespace App\Http\Controllers;

use App\Exports\ReportExport;
use App\Models\Company;
use App\Models\ExcelDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelFacade;

class ExcelController extends Controller
{
    public function index(){
        $companyId = Session::get('companyId');
        $files = ExcelDetail::where('company_id',$companyId)
            ->orderBy('created_at','DESC')
            ->paginate(10);
        $flag = 1;
        return view('reports.index',compact('files','flag'));

    }

        public static function generateExcelFile($companyId,$month,$year)
        {
    $company = Company::find($companyId);
    $fileName = $company->name . '-' . $month . '-' . $year.'.xlsx';
    $excelDetails = ExcelDetail::create([
       'company_id'=>$companyId,
       'month'=>$month,
       'year'=>$year,
        'file_name' => $fileName
    ]);
            $file =  Excel::download(new ReportExport($companyId,$month,$year), $fileName);
            $filePath = 'Excel/'.$fileName; // Desired path within the public folder

            Excel::store($file->getFile(),$filePath,'public',ExcelFacade::XLSX);

            return true;
        }

        public function downloadFile($fileId)
        {
            $file = ExcelDetail::find($fileId);


            $filePath = public_path('storage/Excel/'.$file->file_name);

            return response()->download($filePath, $file->file_name, [], 'inline');

        }
}
