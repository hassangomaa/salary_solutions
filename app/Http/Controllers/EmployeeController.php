<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {

//        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

//        return $request;

        if ($request->ajax()) {
            $query = Employee::select('*');
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

//            $table->editColumn('roles', function ($row) {
//                $labels = [];
//                foreach ($row->roles as $role) {
//                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $role->title);
//                }

//                return implode(' ', $labels);
//            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });


            $table->rawColumns(['actions', 'placeholder', 'roles']);

            return $table->make(true);
        }

//        $roles = Role::get();

        return view('employees.index');//, compact('roles'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
//        return $request->all();
        $employee = Employee::create($request->all());

        return redirect(route('employee.index'));

    }

    public function show(Employee $employee)
    {
//        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
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
