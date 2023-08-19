<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\Deduction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class CommissionController extends Controller
{
    public function index(Request $request,$id)
    {
        $companyId = Session::get('companyId');
        if ($request->ajax()) {
            $query = Commission::select('*')->where('employee_id',$id);
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', function ($row) {
                $crudRoutePart = 'commission';
                return view('partials.datatablesActions', compact('crudRoutePart', 'row'));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });
            $table->editColumn('reason', function ($row) {
                return $row->reason ? $row->reason : '';
            });
            $table->editColumn('created_at', function ($row) {
                return $row->created_at ? $row->created_at : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $flag = 1;
        return view('employees.index',compact('flag'));//, compact('roles'));
    }

    public function create($employeeId)
    {

        $flag = 1;
        return view('commission.create', compact('employeeId','flag'));
    }

    public function store(Request $request)
    {
        $employeeId = $request->employee_id;
        Commission::create($request->all());
        return redirect(route('employee.show',$employeeId));
    }
    public function edit($id)
    {
        $commission = Commission::findOrFail($id);
        $flag = 1;
        return view('commission.edit', compact('commission', 'flag'));
    }

    public function update(Request $request, $id)
    {
        $commission = Commission::findOrFail($id);
        $commission->update($request->all());
        return redirect(route('employee.show', $commission->employee_id));
    }

    public function show(Commission $commission)
    {
        $flag = 1 ;
        return view('commission.show',compact('commission','flag'));
    }
    public function destroy(Commission $commission)
    {

        $commission->delete();

        return back();
    }
}
