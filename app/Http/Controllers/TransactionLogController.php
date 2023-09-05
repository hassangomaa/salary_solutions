<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\TransactionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class TransactionLogController extends Controller
{
    public function index(Request $request)
    {
        $companyId = Session::get('companyId');
        if ($request->ajax()) {
            $query = TransactionLog::select('*')->where('company_id', $companyId)->orderBy('created_at', 'DESC');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', function ($row) {

                $viewButton = '<a class="btn btn-xs btn-primary" href="' . route('transactionLog' . '.show', $row->id) . '">' .
                    trans('global.view') . '
    </a>';
                return $viewButton;


            });

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });

            if (App::getLocale() == 'ar') {
                $table->editColumn('statement', function ($row) {
                    return $row->statement_ar ? $row->statement_ar : '';
                });
                $table->editColumn('type', function ($row) {
                    return $row->type_ar ? $row->type_ar : '';
                });

            } else {
                $table->editColumn('statement', function ($row) {
                    return $row->statement_en ? $row->statement_en : '';
                });
                $table->editColumn('type', function ($row) {
                    return $row->type_en ? $row->type_en : '';
                });
            }
            $table->editColumn('created_at', function ($row) {
                return $row->created_at ? $row->created_at : '';
            });

            $table->rawColumns(['actions', 'placeholder']);
            return $table->make(true);


        }
        $flag = 1;
        return view('transaction-log.index', compact('flag'));
    }

    public function show($id)
    {
        $transaction = TransactionLog::find($id);
        $flag = 1 ;
        return view('transaction-log.show',compact('flag','transaction'));
    }

    public static function borrowLog($employeeId, $amount)
    {
        $employee = Employee::with('company')->where('id', $employeeId)->first();
        $log = new TransactionLog();

        $statement_en = 'The employee ' . $employee->name . ' has borrowed the money amount ' . $amount .
            '. The current company credit is ' . $employee->company->credit;

        $statement_ar = 'الموظف ' . $employee->name . ' استلف ' . $amount .
            '. المال المتوفر في الخزينة:  ' . $employee->company->credit;


        $log->company_id = $employee->company->id;
        $log->amount = $amount;
        $log->type_ar = 'سلفه';
        $log->type_en = 'Borrowing';
        $log->statement_ar = $statement_ar;
        $log->statement_en = $statement_en;

        $log->save();
    }

    public static function withdrawLog($company,$withdrawDetails){

        $statement_en = 'The amount '.  $withdrawDetails->amount . ' has been withdrawn from company\'s safe for this statement '
        . $withdrawDetails->statement . '...' . 'The company current credit is '  . $company->credit;

        $statement_ar = 'لقد تم سحب  '.  $withdrawDetails->amount . ' من خزنة الشركة لهذا السبب  '
        . $withdrawDetails->statement . '...' . 'رصيد الشركة الحالي:  '  . $company->credit;

        $log = new TransactionLog();
        $log->company_id = $company->id;
        $log->amount = $withdrawDetails->amount;
        $log->type_ar = 'سحب';
        $log->type_en = 'withdraw';
        $log->statement_ar = $statement_ar;
        $log->statement_en = $statement_en;

        $log->save();


    }


    public static function depositLog($company,$withdrawDetails){

        $statement_en = 'The amount '.  $withdrawDetails->amount . ' has been deposited to the company\'s safe for this statement '
        . $withdrawDetails->statement . '...' . 'The company current credit is '  . $company->credit;

        $statement_ar = 'لقد تم ايداع المبلغ  '.  $withdrawDetails->amount . ' الي خزنة الشركة لهذا السبب  '
        . $withdrawDetails->statement . '...' . 'رصيد الشركة الحالي:  '  . $company->credit;

        $log = new TransactionLog();
        $log->company_id = $company->id;
        $log->amount = $withdrawDetails->amount;
        $log->type_ar = 'ايداع';
        $log->type_en = 'deposit';
        $log->statement_ar = $statement_ar;
        $log->statement_en = $statement_en;

        $log->save();


    }


    public static function salariesLog($company,$totalNetSalaries,$month){

        $statement_en = 'The amount '.  $totalNetSalaries . ' has been withdrawn from company\'s safe for paying month: '.$month . ' Salaries '
             . '...' . 'The company current credit is '  . $company->credit;

        $statement_ar = 'لقد تم سحب  ' . $totalNetSalaries . ' من خزنة الشركة لدفع مرتبات شهر   '
            . $month . '...' . 'رصيد الشركة الحالي:  '  . $company->credit;


        $log = new TransactionLog();
        $log->company_id = $company->id;
        $log->amount = $totalNetSalaries;
        $log->type_ar = 'مرتبات';
        $log->type_en = 'Salaries';
        $log->statement_ar = $statement_ar;
        $log->statement_en = $statement_en;

        $log->save();


    }


}
