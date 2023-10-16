<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Borrowing\borrowing_dates;
use App\Models\Borrowing\employeeBorrowing;
use App\Models\Employee;
use App\Models\TransactionLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TransactionLogController extends Controller
{
    public function index(Request $request)
    {
        $companyId = Session::get('companyId');
        if ($request->ajax()) {
            $query = TransactionLog::select('*')->orderBy('created_at', 'DESC');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', function ($row) {

                $viewButton = '<a class="btn btn-xs btn-primary" href="' . route('transactionLog' . '.show', $row->id) . '">' .
                    trans('global.view') . '
    </a>';

                $deleteButton = '<form action="'.route('transactionLog' . '.destroy', $row->id) . '" method="POST" onsubmit="return confirm(' . trans('global.areYouSure') .')" style="display: inline-block;">

        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="'. csrf_token()  . '">
        <input type="submit" class="btn btn-xs btn-danger" value="' . trans('global.delete') .'">
    </form>' ;
                $buttons = $viewButton . '<br>' . $deleteButton ;
                return $buttons;


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
        $flag = 1;
        return view('transaction-log.show', compact('flag', 'transaction'));
    }

    public static function borrowLog($employeeId, $amount,$date,$safe)
    {
//           $safe;

//        return     $safe->value ;
        // $safe

        $employee = Employee::where('id', $employeeId)->first();
        $log = new TransactionLog();

        $statement_en = 'The employee ' . $employee->name . ' has borrowed the money amount ' . $amount .
            '. The current safe credit is ' . $safe->value;

        $statement_ar = 'الموظف ' . $employee->name .
            ' استلف ' . $amount .
            '. المال المتوفر في الخزينة:  ' . $safe->value;


        // $log->company_id = $employee->company->id;
        $log->amount = $safe->value;
        $log->deposite = 0;
        $log->withdraw = $amount;
        $log->type_ar = 'سلفه';
        $log->type_en = 'Borrowing';
        $log->statement_ar = $statement_ar;
        $log->statement_en = $statement_en;

        $log->save();
        return $log;
    }

    public static function withdrawLog($withdrawDetails,$safe)
    {

        $statement_en = 'The amount ' . $withdrawDetails->amount . ' has been withdrawn from  safe '.$safe->name.' for this statement '
            . $withdrawDetails->statement . '...' . 'The current safe is ' . $safe->value;

        $statement_ar = 'لقد تم سحب  ' . $withdrawDetails->amount .
            ' من خزنة '.$safe->name.
            ' لهذا السبب  ' . $withdrawDetails->statement .
            '...' . 'رصيد الخزنه الحالي:  ' . $safe->value;

        $log = new TransactionLog();
        // $log->company_id = $company->id;
        $log->amount = $safe->value;
        $log->deposite = 0;
        $log->withdraw = $withdrawDetails->amount;
        $log->type_ar = 'سحب';
        $log->type_en = 'withdraw';
        $log->statement_ar = $statement_ar;
        $log->statement_en = $statement_en;

        $log->save();

        return $log;


    }


    public static function depositLog($depositDetails, $safe)
    {

        $statement_en = 'The amount ' . $depositDetails->amount . ' has been deposited to the  safe '.$safe->name.' for this statement '
            . $depositDetails->statement . '...' . 'The Safe credit is ' . $safe->value;

        $statement_ar = 'لقد تم ايداع المبلغ  ' . $depositDetails->amount . ' الي خزنة '.$safe->name.' لهذا السبب  '
            . $depositDetails->statement . '...' . 'رصيد الخزنه الحالي:  ' . $safe->value;

        $log = new TransactionLog();
        // $log->company_id = $company->id;
        $log->amount = $safe->value;
        $log->deposite = $depositDetails->amount;
        $log->withdraw = 0;
        $log->type_ar = 'ايداع';
        $log->type_en = 'deposit';
        $log->statement_ar = $statement_ar;
        $log->statement_en = $statement_en;

        $log->save();

        return $log;


    }


    public static function salariesLog($safe, $totalNetSalaries, $month)
    {

        $statement_en = 'The amount ' . $totalNetSalaries . ' has been withdrawn from  safe for paying month: ' . $month . ' Salaries '
            . '...' . 'The Current Safe is ' . $safe->value;

        $statement_ar = 'لقد تم سحب  ' . $totalNetSalaries . ' من خزنة  لدفع مرتبات شهر   '
            . $month . '...' . 'رصيد الخزنه الحالي:  ' . $safe->safe;


        $log = new TransactionLog();
        $log->amount = $safe->value;
        $log->deposite = 0;
        $log->withdraw = $totalNetSalaries;
        $log->type_ar = 'مرتبات';
        $log->type_en = 'Salaries';
        $log->statement_ar = $statement_ar;
        $log->statement_en = $statement_en;

        $log->save();


    }

    public function massDestroy(Request $request)
    {
        TransactionLog::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function destroy(TransactionLog $transactionLog)
    {

        $transactionLog->delete();

        return back();
    }
}
