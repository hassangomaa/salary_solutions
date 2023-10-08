<?php

namespace App\Http\Controllers;

use App\Actions\SafeActions;
use App\Http\Requests\Borrowing\BorrowingRequest;
use App\Models\Borrow;
use App\Models\Borrowing\borrowing_dates;
use App\Models\Borrowing\employeeBorrowing;
use App\Models\Company;
use App\Models\Employee;
use App\Models\FollowUp;
use App\Models\Safe\Safe;
use App\Models\Safe\SafeTransactions;
use App\Models\TransactionLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\Wizard\Percentage;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BorrowingController extends Controller
{

    public function index(Request $request)
    {
        $companyId = Session::get('companyId');
        $company = Company::find($companyId);
//                $month = ReportController::getCurrentMonth($company);
//                $year = ReportController::getCurrntYear($company);
//                $month = $company->current_month;
//                $year=  $company->current_year;
        if ($request->ajax()) {
            $query = Borrow::with('employee')
//                                ->where('month',  $month)
//                                ->where('year',  $year)
                ->whereHas('employee', function ($query) use ($companyId) {
                    $query->where('company_id', $companyId);
                })->orderBy('month','ASC');
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
        $flag = 1;
        return view('borrowing.index', compact('flag'));
    }

    public function create()
    {
        $companyId = Session::get('companyId');

        $employees = Employee::where('company_id', $companyId)->get();
        $company = Company::find($companyId);

        $flag = 1;
        $safes = Safe::get();
        return view('borrowing.create', compact('employees', 'flag', 'safes'));
    }

    // public function store(BorrowingRequest $request)
    // {

    //     $companyId = Session::get('companyId');
    //     $company = Company::find($companyId);

    //     // $this->decreaseCompanyCredit($company,$request->amount);
    //     // $company->save();

    //     if($request->has('other_employee_id') && $request->other_employee_id != NULL){
    //         $request['employee_id']=$request->other_employee_id;
    //         $user=Employee::find($request['employee_id']);
    //         if(!$user)
    //             return redirect()->back()->withErrors('this User Not Found');
    //     }
    //     $user=Employee::find($request['employee_id']);


    //     $date=[$request->start_month ,$request->end_month];


    //     $borrowing = new Borrow();
    //     $modifiedStartMonth =  $request['start_month'].'-1';

    //     $start = \Carbon\Carbon::parse($modifiedStartMonth);
    //     $month = $start->format('m');


    //     $borrowing->employee_id = $request['employee_id'] === 0 ? $request['other_employee_id'] : $request['employee_id'];
    //     $borrowing->month = $month;
    //     $borrowing->amount = $request['amount'];
    //     $borrowing->statement = $request['statement'];
    //     // $borrowing->percentage=$request['Percentage'];



    //     // Save the new borrowing record
    //     $borrowing->save();


    //     $safe=(new SafeActions($request['safe_id'],"سلفه للموظف $user->name ",$request['amount'],User::class,$request['employee_id']));

    //     $safe=$safe->withdraw();

    //         if(!isset($request['percentage_check'])){
    //         // return "F";
    //             $start = Carbon::parse($request['start_month'].'-1');
    //             $end = Carbon::parse($request['end_month'].'-1')->addMonth();

    //                 $numberOfMonths = $end->diffInMonths($start);

    //             $period = \Carbon\CarbonPeriod::create($start, '1 month', $end);

    //                 foreach ($period as $date) {
    //                     $monthFormat = $date->format('m');
    //                     $yearFormat = $date->format('Y');

    //                     $borrowing_date = borrowing_dates::where('month', $monthFormat)->where('year', $yearFormat)->first();

    //                     $amount_value = ($numberOfMonths > 0) ? $request['amount'] / $numberOfMonths : $request['amount'];
    //                     $percentage = ($numberOfMonths > 0) ? ($amount_value / $request['amount']) * 100 : 100;

    //                     if($borrowing_date){
    //                         employeeBorrowing::create([
    //                         'user_id'=>$request['employee_id'],
    //                         'amount'=>$amount_value,
    //                         'date_id'=>$borrowing_date->id,
    //                         'percentage'=>$percentage
    //                     ]);
    //                 }else{
    //                     $borrowing_date=borrowing_dates::create([
    //                         'month'=>$monthFormat,
    //                         'year'=>$yearFormat,
    //                     ]);
    //                     employeeBorrowing::create([
    //                         'user_id'=>$request['employee_id'],
    //                         'amount'=>$amount_value,
    //                         'date_id'=>$borrowing_date->id,
    //                         'percentage'=>$percentage
    //                     ]);
    //                     }

    //                 }
    //             }else{
    //                 $monthFormat = $month;
    //                 $yearFormat = Carbon::parse($request['start_date']);
    //                 $borrowing_date = borrowing_dates::where('month', $monthFormat)->where('year', $yearFormat)->first();

    //                 $amount_value=$request['amount'];
    //                 $percentage=$request['percentage'];
    //                 if($borrowing_date){
    //                     employeeBorrowing::create([
    //                     'user_id'=>$request['employee_id'],
    //                     'amount'=>$amount_value,
    //                     'date_id'=>$borrowing_date->id,
    //                     'percentage'=>$percentage
    //                 ]);
    //             }else{
    //                 $borrowing_date=borrowing_dates::create([
    //                     'month'=>$monthFormat,
    //                     'year'=>$yearFormat,
    //                 ]);
    //                 employeeBorrowing::create([
    //                     'user_id'=>$request['employee_id'],
    //                     'amount'=>$amount_value,
    //                     'date_id'=>$borrowing_date->id,
    //                     'percentage'=>$percentage
    //                 ]);
    //                 }
    //             }




    //     TransactionLogController::borrowLog($request['employee_id'],$request->amount,$date,$safe);



    //     return redirect(route('borrowing.index'))->with('success','Successfully');

    // }


    public function store(BorrowingRequest $request)
    {
//        return $request->all();
        $companyId = Session::get('companyId');
        $company = Company::find($companyId);

        // $this->decreaseCompanyCredit($company,$request->amount);
        // $company->save();

        if ($request->has('other_employee_id') && $request->other_employee_id != NULL) {
            $request['employee_id'] = $request->other_employee_id;
            $user = Employee::find($request['employee_id']);
            if (!$user)
                return redirect()->back()->withErrors('this User Not Found');
        }
        $user = Employee::find($request['employee_id']);


        $date = [$request->start_month, $request->end_month];


        $borrowing = new Borrow();
        $modifiedStartMonth =  $request['start_month'] . '-1';

        $start = \Carbon\Carbon::parse($modifiedStartMonth);
        $month = $start->format('m');

        if($request['start_month']=== null && $request['end_month'] === null)
        {
            $month = $company->current_month;
            $year = $company->current_year;
        }
        $borrowing->employee_id = $request['employee_id'] === 0 ? $request['other_employee_id'] : $request['employee_id'];
        $borrowing->month = $month;
        $borrowing->amount = $request['amount'];
        $borrowing->statement = $request['statement'];
        // $borrowing->percentage=$request['Percentage'];



        // Save the new borrowing record
        $borrowing->save();


        $safe = (new SafeActions($request['safe_id'], "سلفه للموظف $user->name ", $request['amount'], User::class, $request['employee_id']));

        $safe = $safe->withdraw();

      /*  if (!isset($request['percentage_check'])) {
            // return "F";
            $start = Carbon::parse($request['start_month'] . '-1');
            $end = Carbon::parse($request['end_month'] . '-1')->addMonth();

            $numberOfMonths = $end->diffInMonths($start);

            $period = \Carbon\CarbonPeriod::create($start, '1 month', $end);

            foreach ($period as $date) {
                $monthFormat = $date->format('m');
                $yearFormat = $date->format('Y');

                $borrowing_date = borrowing_dates::where('month', $monthFormat)->where('year', $yearFormat)->first();

                $amount_value = ($numberOfMonths > 0) ? $request['amount'] / $numberOfMonths : $request['amount'];
                $percentage = ($numberOfMonths > 0) ? ($amount_value / $request['amount']) * 100 : 100;

                if ($borrowing_date) {
                    employeeBorrowing::create([
                        'user_id' => $request['employee_id'],
                        'amount' => $amount_value,
                        'date_id' => $borrowing_date->id,
                        'percentage' => $percentage
                    ]);
                } else {
                    $borrowing_date = borrowing_dates::create([
                        'month' => $month,
                        'year' => $year,
                    ]);
                    employeeBorrowing::create([
                        'user_id' => $request['employee_id'],
                        'amount' => $amount_value,
                        'date_id' => $borrowing_date->id,
                        'percentage' => $percentage
                    ]);
                }
            }
        } else {*/
            $monthFormat = $month;
            $yearFormat = Carbon::parse($request['start_date']);
            $borrowing_date = borrowing_dates::where('month', $monthFormat)->where('year', $yearFormat)->first();

            $amount_value = $request['amount'];
            $percentage = 100.00;
            if ($borrowing_date) {
                employeeBorrowing::create([
                    'user_id' => $request['employee_id'],
                    'amount' => $amount_value,
                    'date_id' => $borrowing_date->id,
                    'percentage' => $percentage
                ]);
            } else {
                $borrowing_date = borrowing_dates::create([
                    'month' =>  $month,
                    'year' => $year,
                ]);
                employeeBorrowing::create([
                    'user_id' => $request['employee_id'],
                    'amount' => $amount_value,
                    'date_id' => $borrowing_date->id,
                    'percentage' => $percentage
                ]);
            }
      //  }




        TransactionLogController::borrowLog($request['employee_id'], $request->amount, $date, $safe);



        return redirect(route('borrowing.index'))->with('success', 'Successfully');
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


    public  function decreaseCompanyCredit($company, $amount)
    {
        $company->credit -= $amount;
    }

    public function show(Borrow $borrow)
    {
        $borrow->load('employee');
        $flag = 1;
        return view('borrowing.show', compact('borrow', 'flag'));
    }
    public function edit(Borrow $borrow)
    {
        $borrow->load('employee');
        $flag = 1;
        return view('borrowing.edit', compact('borrow', 'flag'));
    }

    public function update(Request $request, $id)
    {
        $companyId = Session::get('companyId');

        $borrow = Borrow::with('employee')->where('id', $id)->first();

        $this->updateCompanyCredit($companyId, $borrow->amount, $request->amount);
        $borrow->update($request->all());
        $borrow->save();
        return redirect(route('borrowing.show', $id));
    }

    private function updateCompanyCredit($companyId, $oldAmount, $newAmount)
    {
        $company = Company::find($companyId);
        $company->credit =    $company->credit + $oldAmount - $newAmount;
        $company->save();
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

    public function storeAJAX(Request $request)
    {
        $followUp = FollowUp::find($request->follow_up_id);
        $followUp->borrow_week_one = $request->week1;
        $followUp->borrow_week_two = $request->week2;
        $followUp->borrow_week_three = $request->week3;
        $followUp->borrow_week_four = $request->week4;
        $followUp->save();
    }
}
