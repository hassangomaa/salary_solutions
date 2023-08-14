<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('attendance.index');
    }

    public function getUsersForAttendance(Request $request)
    {
        if ($request->ajax()) {
            $currentDate = Carbon::now()->toDateString();

            //TODO: filter by column id
            $employeesNotAttendedToday = Employee::whereDoesntHave('attendances', function ($query) use ($currentDate) {
                $query->where('date', $currentDate);

            });

            $table = Datatables::of($employeesNotAttendedToday);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', function ($row) {
                $attendRoute = route('attendance.attendEmployee', $row->id);

                $html = '<a class="btn btn-xs btn-info" href="' . $attendRoute . '">
                      Attend Employee
                         </a>';

                return $html;


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
            $table->editColumn('position', function ($row) {
                return $row->position ? $row->position : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });

            $table->rawColumns(['actions', 'placeholder',]);


            return $table->make(true);
        }
        return view('attendance.index');
    }

    public function attendEmployee($employeeId)
    {
//        return $employeeId;
        $attendance = new Attendance([
            'employee_id' => $employeeId,
            'date' => now()->toDateString(), // or the appropriate date value
        ]);

        $attendance->save();
        return redirect(route('attendance.index'));

    }
}
