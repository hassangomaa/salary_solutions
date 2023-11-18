<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\CompanyPayment;
use App\Models\Employee;
use App\Models\Incentives;
use App\Models\Safe\Safe;
use App\Models\Safe\SafeTransactions;
use App\Models\TransactionLog;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RevertController extends Controller
{
    public function __invoke()
    {

        $from_date = Carbon::parse(Carbon::now()->subMonth()->format('Y') . Carbon::now()->subMonth()->format('m') . '25')->format('Y-m-d');
        $to_date = Carbon::parse(Carbon::now()->format('Y') . Carbon::now()->format('m') . '25')->format('Y-m-d');

        try{
            DB::beginTransaction();

        $employees = Employee::get();
        foreach ($employees as $em) {
            $em->employeeBorrowinng->each->delete();
            $em->attendances->whereBetween('date', [$from_date, $to_date])->each->delete();
            $em->commissions->each->delete();
            $em->deductions->each->delete();
            $em->followUps->each->delete();
            $em->borrows->each->delete();
            $em->incentives->each->delete();
        }

        $employees->each->delete();
        $safes = Safe::select('name', 'value', 'type')->get();
        $safes_data = $safes->all();

        Safe::select('name', 'value', 'type')->delete();
        SafeTransactions::get()->each->delete();

        foreach ($safes_data as $d) {
            Safe::create([
                'name' => $d->name,
                'value' => $d->value,
                'type' => $d->type,
                'created_at' => Carbon::now()
            ]);
        }

        TransactionLog::get()->each->delete();
        CompanyPayment::get()->each->delete();
        DB::commit();
    }catch(Exception $e){
        DB::rollback();



    }
    return redirect()->back()->with('message','تم الترحيل بنجاح');




    }
}
