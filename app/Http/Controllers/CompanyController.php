<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyPayment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    static $companyId = null;

    public function __construct()
    {
        self::$companyId = null;
    }

    public function companyDashboard()
    {
        if (auth()->check()) {

            CompanyController::$companyId = null;
            $companies = Company::all();
            $flag = 0;
            return view('company.companyDashboard', compact('companies', 'flag'));
        }
        return view('welcome_ar');
    }

    public function indexBlade()
    {
        $flag = 0;

        return view('company.index', compact('flag'));
    }

    public function index(Request $request)
    {
//        return  $request;
        if ($request->ajax()) {
            $query = Company::select('*');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', function ($row) {
                $crudRoutePart = 'company';
                return view('partials.datatablesActions', compact('crudRoutePart', 'row'));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('credit', function ($row) {
                return $row->credit ? $row->credit : 0;
            });


            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        return redirect(route('company.companyDashboard'));
    }

    public function show(Company $company)
    {
        $flag = 0;
        return view('company.show', compact('company', 'flag'));
    }

    public function create()
    {
        $flag = 0;
        return view('company.create',compact('flag'));
    }

    public function store(Request $request)
    {
        Company::create($request->all());

        return redirect(route('company.indexBlade'));

    }

    public function edit(Company $company)
    {
        $flag = 0;

        return view('company.edit', compact('company', 'flag'));
    }

    public function update(Request $request, Company $company)
    {
        $company->update($request->all());
        return redirect(route('company.indexBlade'));
    }


    public function massDestroy(Request $request)
    {
//        return $request;
//        return redirect('/test')->with($request);
        Company::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function clickOnCompany($companyId)
    {
        Session::put('companyId', $companyId);
        $this->checkIfNewMonth($companyId);
        return redirect()->route('employee.index');

    }

    private function checkIfNewMonth($companyId)
    {
        $company = Company::find($companyId);
        $companyCurrentMonth = $company->current_month;
        $companyCurrentYear = $company->current_year;
        $actualMonth = today()->month;
        $companyStartDay = (int)$company->start_month;
        $actualDay = today()->day;

        $report = new ReportController();
        //Check if new Month Started
        if( ($companyStartDay <= $actualDay) && ($companyCurrentMonth%13 < $actualMonth%13))
        {
           $report->calculateMonthlyReport($companyId,$companyCurrentMonth,$companyCurrentYear);

            if($companyCurrentMonth == 12)
            {
                $company->current_month = 1;
                $company->current_year ++;
            }else{
                $company->current_month ++;
            }
            $company->save();

            ReportController::newMonth($company);
        }
    }


}
