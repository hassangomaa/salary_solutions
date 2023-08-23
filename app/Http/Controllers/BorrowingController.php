<?php

namespace App\Http\Controllers;

use App\Models\FollowUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BorrowingController extends Controller
{
    public function index()
    {
        $companyId = Session::get('companyId');

        $followUps = FollowUp::with('employee')->whereHas('employee', function ($query) use ($companyId) {
            $query->where('company_id', $companyId);
        })->where('month', 8)
            ->get();
        $flag = 1;
        return view('borrowing.index', compact('flag', 'followUps'));
    }

    public function store(Request $request){
       $followUp = FollowUp::find($request->follow_up_id);
       $followUp->borrow_week_one = $request->week1;
       $followUp->borrow_week_two = $request->week2;
       $followUp->borrow_week_three = $request->week3;
       $followUp->borrow_week_four = $request->week4;
       $followUp->save();
    }
}
