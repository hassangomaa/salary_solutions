<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class CompanyPaymentsController extends Controller
{
    public function index(Request $request)
    {
        $companyId = Session::get('companyId');
        if ($request->ajax()) {
            $query = CompanyPayment::select('*')
                ->where('company_id', $companyId);
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp; <br>');
            $table->addColumn('actions', function ($row) {
                $crudRoutePart = 'companyPayments';
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
        $paymentTypes = CompanyPayment::paymentType();
        $flag = 1;
        return view('company-payments.index', compact('flag', 'company', 'paymentTypes'));//, compact('roles'));
    }

    /*
     *     START CREATE PAYMENT
     */

    public function create()
    {
        $flag = 1;
        $paymentTypes = CompanyPayment::paymentType();

        return view('company-payments.create', compact('flag', 'paymentTypes'));
    }

    public function store(Request $request)
    {
        $companyId = Session::get('companyId');
        $company = Company::find($companyId);

        if ($request->type == 'deposit') {
            $this->deposit($company, $request);
        }
        if ($request->type == 'withdrawal') {
            $flag = $this->withdraw($company, $request);
            if ($flag == false) {
                return redirect()->back();
            }
        }

        $company->save();
        return redirect(route('companyPayments.index'));
    }

    private function deposit($company, $request)
    {
        $amount = $request->amount;
        $company->credit += $amount;
        $this->saveTransactionDetails($company->id, $request);

    }

    private function withdraw($company, $request)
    {
        $amount = $request->amount;
        if ($company->credit < $amount) {
            return false;
        }

        $company->credit -= $amount;
        $this->saveTransactionDetails($company->id, $request);
        return true;
    }


    private function saveTransactionDetails($companyId, $request)
    {
        $companyPayment = new CompanyPayment;
        $companyPayment->amount = $request->input('amount');
        $companyPayment->statement = $request->input('statement');
        $companyPayment->type = $request->type;
        $companyPayment->company_id = $companyId;
        $companyPayment->save();
    }

    /*
    *     END CREATE PAYMENT
    */

    public function show($depositId)
    {
        $deposit = CompanyPayment::with('company')->find($depositId);
        $flag = 1;
        return view('company-payments.show', compact('flag', 'deposit'));

    }

    public function edit($depositId)
    {
        $deposit = CompanyPayment::with('company')->find($depositId);
        $flag = 1;
        $paymentTypes = CompanyPayment::paymentType();

        return view('company-payments.edit', compact('flag', 'deposit', 'paymentTypes'));

    }


    public function update(Request $request, $depositId)
    {
        $deposit = CompanyPayment::with('company')->find($depositId);
        $company = Company::find($deposit->company_id);

        $currntCredit = $company->credit;
        $oldCredit = $deposit->amount;
        $newCredit = $request->amount;

        if ($request->type == 'deposit') {
            $company->credit = $this->editCompanyDepositPayment($currntCredit,$oldCredit ,$newCredit);
        }
        if ($request->type == 'withdrawal') {
            $newCompanyCredit = $this->editCompanyWithdrawPayment($currntCredit,$oldCredit ,$newCredit);
            if($newCompanyCredit < 0)
            {
                return redirect()->back();
            }
        $company->credit = $newCompanyCredit;
        }

        $deposit->type = $request->type;
        $deposit->amount = $request->amount;
        $deposit->statement = $request->statement;

        $company->save();
        $deposit->save();

        return redirect(route('companyPayments.index'));

    }

    private function editCompanyDepositPayment($credit, $oldAmont, $newAmount)
    {
        return $credit - $oldAmont + $newAmount;
    }

    private function editCompanyWithdrawPayment($credit, $oldAmont, $newAmount)
    {
        return $credit + $oldAmont - $newAmount;
    }

    public function massDestroy(Request $request)
    {
        CompanyPayment::whereIn('id', request('ids'))->delete();
        return redirect(route('companyPayments.index'));


    }

    public function destroy($paymentId)
    {
        $pay = CompanyPayment::find($paymentId);
        $pay->delete();

        return back();
    }


}
