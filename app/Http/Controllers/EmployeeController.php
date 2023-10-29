<?php

namespace App\Http\Controllers;

use App\Imports\EmployeesImport;
use App\Models\Borrow;
use App\Models\Company;
use App\Models\Deduction;
use App\Models\Employee;
use App\Models\FollowUp;
use App\Models\Incentives;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

//use Yajra\DataTables\DataTables;
class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $companyId = Session::get('companyId');
        if ($request->ajax()) {
            $query = Employee::select('*')->where('company_id', $companyId)->withTrashed();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', function ($row) {
                $crudRoutePart = 'employee';
                return view('partials.datatablesActions', compact('crudRoutePart', 'row'));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->editColumn('position', function ($row) {
                return $row->position ? $row->position : '';
            });
            $table->editColumn('daily_fare', function ($row) {
                return $row->daily_fare ? $row->daily_fare : '';
            });

            $table->editColumn('overtime_hour_fare', function ($row) {
                return $row->overtime_hour_fare ? $row->overtime_hour_fare : '';
            });

            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
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
        unset($request['_token']);

        $employee = $request->all();
        $companyId = Session::get('companyId');
        $employee['company_id'] = $companyId;

        $company = Company::find($companyId);
        $emp = Employee::create($employee);

        $this->addEmployeeToFollowUpList($emp->id, $company->current_month, $company->current_year);

        return redirect(route('employee.index'));

    }

    public function show(Employee $employee)
    {
        $flag = 1;
        $employee->load('commissions', 'deductions');
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

    public function getAllEmployees(Request $request)
    {
        $companyId = Session::get('companyId');
        $search = $request->get('term');


        $employees = Employee::where('company_id', $companyId)
            ->where('name', 'like', "%$search%")
            ->get(['id', 'name']);

        $response = [];
        foreach ($employees as $employee) {
            $response[] = [
                'name' => $employee->name,
                'id' => $employee->id,
            ];
        }
        return response()->json($response);
//        return Employee::where('company_id',$companyId)->get();
    }

    public function addEmployeeToFollowUpList($employeeId, $month, $year)
    {
        $followUp = new FollowUp();
        $incentive = new Incentives();
        $deduction = new Deduction();

        $followUp->month = $month;
        $followUp->year = $year;
        $followUp->employee_id = $employeeId;

        $incentive->month = $month;
        $incentive->year = $year;
        $incentive->employee_id = $employeeId;

        $deduction->month = $month;
        $deduction->year = $year;
        $deduction->employee_id = $employeeId;

        $followUp->save();
        $deduction->save();
        $incentive->save();
    }

    public function importEmployeesBlade()
    {
        $flag = 1;
        return view('employees.import-all-employees', compact('flag'));
    }

    public function importEmployees(Request $request)
    {
        $companyId = Session::get('companyId');

        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls|max:2048', // Adjust file size limit if needed
        ]);


        // Get the file and store it in a temporary location
        $file = $request->file('excel_file');

        // Import the Excel file using the defined import class
        Excel::import(new EmployeesImport($companyId), $file);



        return redirect()->back()->with('success', 'Excel file imported successfully.');
    }



    public function deletePermanent($id)
    {

          $employee = Employee::withTrashed()->find($id);

        if (!$employee) {
            return back()->with('error', 'Employee not found.');
        }

        // Ensure the authenticated user can access this employee
          $companyId = Session::get('companyId');

//        return $companyId==$employee->company_id+1;

//           if ($employee->company_id !== $companyId) {
//            return 'Unauthorized to permanently delete this employee.';
//        }
           $id;

        $employee->forceDelete();

        return back()->with('success', 'Employee permanently deleted.');
    }




}
