<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Company;
use App\Models\Employee;
use App\Models\FollowUp;
use App\Models\Incentives;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
{


    public function index()
    {
        $companyId = Session::get('companyId');
        $company = Company::find($companyId);
        $month = $company->current_month;
        $year=  $company->current_year;

        $followUps = FollowUp::with('employee')
        ->whereHas('employee', function ($query) use ($companyId) {
            $query->where('company_id', $companyId);
        })
        ->where('month', Carbon::now()->format('m'))
        ->where('year', Carbon::now()->format('Y'))
        // e->get()
        ;
        // ->where('status',FollowUp::USE);

        $total_attendance_houres=$followUps->sum('attended_days');
        $total_extra_hours=$followUps->sum('extra_hours');
        $followUps=$followUps->paginate(10);

        $flag = 1 ;
            //    return $followUps;
 return view('attendance.index',compact('flag','followUps','total_attendance_houres','total_extra_hours'));
    }

    public function updateNumberOfDays(Request $request)
    {
        $followUp =FollowUp::find($request->follow_up_id);
        $followUp->attended_days = $request->number_of_days;
        $followUp->save();

    }
/*
//
//    public function index(Request $request)
//    {
//        $companyId = Session::get('companyId');
//        $month = BorrowingController::getCurrentMonth($companyId);
//
//        $flag = 1;
//        if ($request->ajax()) {
//
//            //TODO: filter by column id
//            $followUps = FollowUp::with('employee')->whereHas('employee', function ($query) use ($companyId) {
//                $query->where('company_id', $companyId);
//            })->where('month', $month);
//            $table = Datatables::of($followUps);
//
//            $table->addColumn('placeholder', '&nbsp;');
//            $table->addColumn('actions', function ($row) {
//                $crudRoutePart = 'attendance';
//                return view('partials.datatablesActions', compact('crudRoutePart', 'row'));
//            });
//
//            $table->addColumn('addData', function ($row) {
//                $html = '<div class="form-group">
//    <a href="' . route('attendance.create',[$row->employee->id,$row->id]) . '" class="btn btn-danger">Add Attendance</a>
//</div>';
//                return $html;
//            });
//
//            $table->editColumn('id', function ($row) {
//                return $row->id ? $row->id : '';
//            });
//            $table->editColumn('name', function ($row) {
//                return $row->employee->name ? $row->employee->name : '';
//            });
//            $table->editColumn('position', function ($row) {
//                return $row->employee->position ? $row->employee->position : '';
//            });
//
//            $table->editColumn('overtime_hour_fare', function ($row) {
//                return $row->employee->overtime_hour_fare ? $row->employee->overtime_hour_fare : 0;
//            });
//            $table->editColumn('extra_hours', function ($row) {
//                return $row->extra_hours ? $row->extra_hours : 0;
//            });
//            $table->editColumn('attended_days', function ($row) {
//                return $row->attended_days ? $row->attended_days : '0';
//            });
//            $table->editColumn('daily_fare', function ($row) {
//                return $row->employee->daily_fare ? $row->employee->daily_fare : '0';
//            });
//
//
//            $table->rawColumns(['actions', 'placeholder','addData']);
//
//
//            return $table->make(true);
//        }
//        $flag = 1;
//        return view('attendance.index', compact('flag'));
//    }

    public function create(Employee $employee,$id)
    {
        $incentives = Incentives::with('employee')->where('employee_id',$employee->id)->get();
//        return $incentives;
        $flag = 1;
        return view('attendance.create', compact('flag', 'employee','id','incentives'));
    }

    public function store(Request $request)
    {
        $followUp =  FollowUp::find($request->follow_up_id);
        $followUp->attended_days = $request->attended_days;
        $followUp->extra_hours = $request->extra_hours;
        $followUp->save();
        return redirect(route('attendance.index'));
    }

    public function show($id)
    {
       $followUp = FollowUp::with('employee')->find($id);
       $flag = 1;
    return view('attendance.show', compact('followUp','flag'));
}

    public function edit($id)
    {
        $followUp = FollowUp::with('employee')->where('id',$id)->first();
        $flag = 1;
        return view('attendance.edit', compact('flag', 'followUp','id'));
    }

    public function update(Request $request)
    {
        $followUp = FollowUp::findOrFail($request->follow_up_id);

        $followUp->attended_days = $request->input('attended_days');
        $followUp->extra_hours = $request->input('extra_hours');
        // Update other fields if needed

        $followUp->save();

        return redirect()->route('attendance.index')->with('success', 'Attendance updated successfully.');

    }

    public function massDestroy(Request $request)
    {
//        return $request;
//        return redirect('/test')->with($request);
        FollowUp::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function destroy(FollowUp $followUp)
    {

        $followUp->delete();

        return back();
    }
*/

    /*

  /*  public function attendEmployee($employeeId)
    {
//        return $employeeId;
        $attendance = new Attendance([
            'employee_id' => $employeeId,
            'date' => now()->toDateString(), // or the appropriate date value
        ]);

        $attendance->save();
        return redirect(route('attendance.index'));

    }*/

    public function refreshData(){
        $employee_ids=FollowUp::select('employee_id')->distinct('employee_id')->pluck('employee_id');
        $follow_ups=FollowUp::where('month',Carbon::now()->format('m'))->where('year',Carbon::now()->format('Y'))->get()->keyBy('employee_id');

        foreach($employee_ids as $item){
            if(isset($follow_ups[$item])){
                continue;
            }
            FollowUp::where('employee_id',$item)->latest()->first()->update([
                'status'=>FollowUp::DONE
            ]);

            FollowUp::create([
                'attended_days'=>0,
                'month'=>Carbon::now()->format('m'),
                'year'=>Carbon::now()->format('Y'),
                'daily_wages_earned'=>0,
                'extra_hours'=>0,
                'total_extras'=>0,
                'borrows'=>0,
                'incentives'=>0,
                'deductions'=>0,
                'net_salary'=>0,
                'employee_id'=>$item,
                'status'=>FollowUp::USE
        ]);
    }
    return redirect()->back()->with('message',"Successfull");

    }
}
