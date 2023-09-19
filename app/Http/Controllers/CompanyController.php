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
            $table->editColumn('start_month', function ($row) {
                return $row->start_month ? $row->start_month : '';
            });
            $table->editColumn('end_month', function ($row) {
                return $row->end_month ? $row->end_month : '';
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
        return view('company.create', compact('flag'));
    }

    public function store(Request $request)
    {
        $company = Company::create($request->all());
        $this->companyDateAndYear($company);

        return redirect(route('company.indexBlade'));

    }

    private function companyDateAndYear(Company $company)
    {
        $companyCurrentMonth = today()->month;
        $actualMonth = today()->month;
        $companyCurrentYear = $company->current_year;
        $companyStartDay = (int)$company->start_month;
        $actualDay = today()->day;

        if (($companyStartDay <= $actualDay)) {
            $company->current_month = $companyCurrentMonth;
            $company->current_year = today()->year ;

        } else {
            if (($companyCurrentMonth - 1) % 13 == 0) {
                $company->current_month = 1;
                $company->current_year = today()->year - 1 ;

            }else{
                $company->current_month = ($companyCurrentMonth - 1) % 13;
                $company->current_year = today()->year ;

            }


        }
        $company->save();
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

    public function destroy(Company $company)
    {
        $company->delete();
        return back();
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
        $companyStartDay = (int)$company->start_month;
        $actualDay = today()->day ; // To get the actual day
        $companyCurrentMonth = $company->current_month;
        $companyCurrentYear = $company->current_year;
        $actualMonth = today()->month;

        $report = new ReportController();
        //Check if new Month Started
                //  3 <= 3 && 8 % 13 == 8 < 9    12 < 1
        if (($companyStartDay <= $actualDay) && ( ($companyCurrentMonth < $actualMonth) || ($companyCurrentMonth == 12 && $actualMonth == 1)) ) {
            $report->calculateMonthlyReport($companyId, $companyCurrentMonth, $companyCurrentYear);

            if ($companyCurrentMonth == 12) {
                $company->current_month = 1;
                $company->current_year++;
            } else {
                $company->current_month++;
            }
            $company->save();

            ReportController::newMonth($company);
        }
    }


}
