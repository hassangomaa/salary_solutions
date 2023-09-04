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

            if (App::getLocale() == 'ar')
            {
                $table->editColumn('statement', function ($row) {
                    return $row->statement_ar ? $row->statement_ar : '';
                });
                $table->editColumn('type', function ($row) {
                    return $row->type_ar ? $row->type_ar : '';
                });

            }else{
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
        return view('transaction-log.index',compact('flag'));
    }}
