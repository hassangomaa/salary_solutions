<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Company;
use App\Models\Employee;
use App\Models\FollowUp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BorrowingController extends Controller
{

    public function index(Request $request)
    {
        $companyId = Session::get('companyId');
        $month = Carbon::now()->month;
        if ($request->ajax()) {
            $query = Borrow::with('employee')
                ->where('month', '>=', $month)
                ->whereHas('employee', function ($query) {
                    $query->where('company_id', 1);
                });
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', function ($row) {
                $crudRoutePart = 'borrowing';
                return view('partials.datatablesActions', compact('crudRoutePart', 'row'));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('position', function ($row) {
                return $row->employee->position ? $row->employee->position : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->employee->name ? $row->employee->name : '';
            });
            $table->editColumn('month', function ($row) {
                return $row->month ? $row->month : '';
            });
            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });



            $table->rawColumns(['actions', 'placeholder', 'roles']);

            return $table->make(true);
        }
        $flag= 1;
        return view('borrowing.index',compact('flag'));
    }

    public function create(){
        $companyId = Session::get('companyId');

        $employees = Employee::where('company_id',$companyId)->get();
        $currntMonth = $this->getCurrentMonth($companyId);
        $months = [$currntMonth%13,(++$currntMonth)%13,(++$currntMonth)%13,(++$currntMonth)%13,(++$currntMonth)%13,(++$currntMonth)%13,(++$currntMonth)%13];
        $flag = 1;
        return view('borrowing.create',compact('employees','flag','months'));
    }

    public function store(Request $request)
    {
        $companyId = Session::get('companyId');
        $this->decreaseCompanyCredit($companyId,$request->amount);
        $borrowing = new Borrow();

        $borrowing->employee_id = $request['employee_id'] === 0 ? $request['other_employee_id'] : $request['employee_id'];
        $borrowing->month = $request['month'];
        $borrowing->amount = $request['amount'];
        $borrowing->statement = $request['statement'];

        // Save the new borrowing record
        $borrowing->save();


        return redirect(route('borrowing.index'));
    }

    public function massDestroy(Request $request)
    {
        Borrow::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function destroy(Borrow $borrow)
    {

        $borrow->delete();

        return back();
    }


    public  function decreaseCompanyCredit($companyId,$amount)
    {
        $company = Company::find($companyId);
        $company->credit -= $amount;
        $company->save();
    }

    public function show(Borrow $borrow){
        $borrow->load('employee');
        $flag = 1;
        return view('borrowing.show',compact('borrow','flag'));
    }
   public function edit(Borrow $borrow){
        $borrow->load('employee');
        $flag = 1;
        return view('borrowing.edit',compact('borrow','flag'));
    }

    public function update(Request $request,$id)
    {
        $companyId = Session::get('companyId');

        $borrow = Borrow::with('employee')->where('id',$id)->first();

        $this->updateCompanyCredit($companyId,$borrow->amount,$request->amount);
        $borrow->update($request->all());
        $borrow->save();
        return redirect(route('borrowing.show',$id));

    }

    private function updateCompanyCredit($companyId,$oldAmount,$newAmount)
    {
        $company = Company::find($companyId);
        $company->credit =    $company->credit + $oldAmount - $newAmount;
        $company->save();
    }

    private function getCurrentMonth($companyID)
    {
        $company = Company::find($companyID);
        $day = Carbon::today()->day;
        $companyLastDay =(int)$company->end_month;
        $lastDayOfTheMonth =  Carbon::today()->endOfMonth()->day;
        $isSameMonth = $company->isSameMonth;
        if($isSameMonth == 1)
        {
            return Carbon::today()->month;
        }
        if($companyLastDay <= $day && $day <= $lastDayOfTheMonth)
        {
            return ++Carbon::today()->month;
        }else{
            return Carbon::today()->month;
        }
    }

    //TODO : dont remove until finishing the system
    public function indexAjax()
    { //it didn't use ajax but it's linked with store ajax method
        $companyId = Session::get('companyId');

        $followUps = FollowUp::with('employee')->whereHas('employee', function ($query) use ($companyId) {
            $query->where('company_id', $companyId);
        })->where('month', 8)
            ->get();
        $flag = 1;
        return view('borrowing.index', compact('flag', 'followUps'));
    }

    public function storeAJAX(Request $request){
       $followUp = FollowUp::find($request->follow_up_id);
       $followUp->borrow_week_one = $request->week1;
       $followUp->borrow_week_two = $request->week2;
       $followUp->borrow_week_three = $request->week3;
       $followUp->borrow_week_four = $request->week4;
       $followUp->save();
    }
}
