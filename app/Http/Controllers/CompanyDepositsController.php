<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class CompanyDepositsController extends Controller
{
    public function index(Request $request)
    {
        $companyId = Session::get('companyId');
        if ($request->ajax()) {
            $query = CompanyPayment::select('*')
                ->where('company_id', $companyId)
                ->where('type', 'deposit');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp; <br>');
            $table->addColumn('actions', function ($row) {
                $crudRoutePart = 'companyPayments.deposit';
                return view('partials.datatablesActions', compact('crudRoutePart', 'row'));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : 0;
            });
            $table->editColumn('statement', function ($row) {
                return $row->statement ? $row->statement : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? $row->type : '';
            });
            $table->editColumn('created_at', function ($row) {
                return $row->created_at->format('Y-m-d H:i') ? $row->created_at->format('Y-m-d H:i') : '';
//                return $row->created_at->format('D, M j, Y g:i A') ? $row->created_at->format('D, M j, Y g:i A') : '';
            });


            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        $company = Company::find($companyId);
        $flag = 1;
        return view('company-payments.deposit.index', compact('flag', 'company'));//, compact('roles'));
    }

    public function create()
    {
        $flag = 1;
        return view('company-payments.deposit.create', compact('flag'));
    }

    public function store(Request $request)
    {
        $companyId = Session::get('companyId');
        $amount = $request->amount;

        $companyPayment = new CompanyPayment;
        $companyPayment->amount = $request->input('amount');
        $companyPayment->statement = $request->input('statement');
        $companyPayment->type = 'deposit';
        $companyPayment->company_id = $companyId;

        $companyPayment->save();
        $this->increaseCompanyCredit($companyId, $amount);
        return redirect(route('companyPayments.deposit.index'));
    }

    public function increaseCompanyCredit($companyId, $amount)
    {
        $company = Company::find($companyId);
        $company->credit += $amount;

        $company->save();

    }

    public function show($depositId)
    {
        $deposit = CompanyPayment::with('company')->find($depositId);
        $flag = 1;
        return view('company-payments.deposit.show', compact('flag', 'deposit'));

    }

    public function edit($depositId)
    {
        $deposit = CompanyPayment::with('company')->find($depositId);
        $flag = 1;
        return view('company-payments.deposit.edit', compact('flag', 'deposit'));

    }

    public function update(Request $request, $depositId)
    {
        $deposit = CompanyPayment::with('company')->find($depositId);
        $company = Company::find($deposit->company_id);

        $company->credit = $this->editCompanyCredit($company->credit, $deposit->amount, $request->amount);

        $deposit->amount = $request->amount;
        $deposit->statement = $request->statement;

        $company->save();
        $deposit->save();

        return redirect(route('companyPayments.deposit.index'));

    }

    private function editCompanyCredit($credit, $oldAmont, $newAmount)
    {
        return $credit - $oldAmont + $newAmount;
    }


    public function massDestroy(Request $request)
    {
        CompanyPayment::whereIn('id', request('ids'))->delete();
        return redirect(route('companyPayments.deposit.index'));


    }

    public function destroy($paymentId)
    {
        $pay = CompanyPayment::find($paymentId);
        $pay->delete();

        return back();
    }

}
