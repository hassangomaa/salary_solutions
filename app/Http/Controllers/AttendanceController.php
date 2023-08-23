<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\FollowUp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
{


    public function index()
    {
        $companyId = Session::get('companyId');

        $followUps = FollowUp::with('employee')->whereHas('employee',function ($query) use($companyId){
            $query->where('company_id',$companyId);
        })->where('month',8)
            ->get();
        $flag = 1 ;
        return view('attendance.index',compact('flag','followUps'));
    }

    public function updateNumberOfDays(Request $request)
    {
        $followUp =FollowUp::find($request->follow_up_id);
        $followUp->attended_days = $request->number_of_days;
        $followUp->save();

    }


    /*public function getUsersForAttendance(Request $request)
    {
        $companyId = Session::get('companyId');

        if ($request->ajax()) {
            $currentDate = Carbon::now()->toDateString();

            //TODO: filter by column id
            $employeesNotAttendedToday = Employee::where('company_id',$companyId)->whereDoesntHave('attendances', function ($query) use ($currentDate) {
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

    }*/
}
