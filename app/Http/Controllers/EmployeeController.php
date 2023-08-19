<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
//use Yajra\DataTables\DataTables;
class EmployeeController extends Controller
{
    public function index(Request $request)
    {

        $companyId = Session::get('companyId');
        if ($request->ajax()) {
            $query = Employee::select('*')->where('company_id', $companyId);
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', function ($row) {
                $crudRoutePart = 'employee';
                return view('partials.datatablesActions', compact('crudRoutePart', 'row'));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('Daily fare', function ($row) {
                return $row->daily_fare ? $row->daily_fare : '';
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
            $table->editColumn('debit', function ($row) {
                return $row->debit ? $row->debit : '';
            });

//            $table->editColumn('amount', function ($row) {
//                return $row->commission->amount ? $row->commission->amount : '';
//            });
//            $table->editColumn('commission', function ($row) {
//                return $row->commission->reason ? $row->commission->reason : '';
//            });


            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });


            $table->rawColumns(['actions', 'placeholder', 'roles']);

            return $table->make(true);
        }

//        $roles = Role::get();
        $flag = 1;
        return view('employees.index', compact('flag'));//, compact('roles'));
    }

    

    public function create()
    {
        $flag = 1;

        return view('employees.create', compact('flag'));
    }

    public function store(Request $request)
    {
//        return $request->all();
        $employee = Employee::create($request->all());

        return redirect(route('employee.index'));

    }

    public function show(Employee $employee)
    {
        $flag = 1;
        $employee->load('commissions','deductions');
        return view('employees.show', compact('employee', 'flag'));
    }

    public function edit(Employee $employee)
    {
        $flag = 1;
        return view('employees.edit', compact('employee', 'flag'));
    }

    public function update(Request $request, Employee $employee)
    {
        $employee->update($request->all());
        return redirect(route('employee.index'));
    }

    public function massDestroy(Request $request)
    {
//        return $request;
//        return redirect('/test')->with($request);
        Employee::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function destroy(Employee $employee)
    {

        $employee->delete();

        return back();
    }

}
