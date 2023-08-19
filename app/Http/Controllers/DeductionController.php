<?php

namespace App\Http\Controllers;

use App\Models\Deduction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class DeductionController extends Controller
{
    public function index(Request $request,$id)
    {
        $companyId = Session::get('companyId');
        if ($request->ajax()) {
            $query = Deduction::select('*')->where('employee_id',$id);
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', function ($row) {
                $crudRoutePart = 'deduction';
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
        return view('deduction.create', compact('employeeId','flag'));
    }

    public function store(Request $request)
    {
        $employeeId = $request->employee_id;
        Deduction::create($request->all());
        return redirect(route('employee.show',$employeeId));
    }
    public function edit($id)
    {
        $deduction = Deduction::findOrFail($id);
        $flag = 1;
        return view('deduction.edit', compact('deduction', 'flag'));
    }

    public function update(Request $request, $id)
    {
        $deduction = Deduction::findOrFail($id);
        $deduction->update($request->all());
        return redirect(route('employee.show', $deduction->employee_id));
    }

    public function show(Deduction $deduction)
    {
        $flag = 1 ;
        return view('deduction.show',compact('deduction','flag'));
    }
    public function destroy(Deduction $deduction)
    {

        $deduction->delete();

        return back();
    }
}
