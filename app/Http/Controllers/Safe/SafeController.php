<?php

namespace App\Http\Controllers\Safe;

use App\Actions\SafeActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Safe\SafeRequest;
use App\Http\Requests\SafeTransferRequest;
use App\Models\Safe\Safe;
use App\Models\Safe\SafeTransactions;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SafeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
        $query = Safe::select('*');
        $table = DataTables::of($query);

        $table->addColumn('placeholder', '&nbsp;');
        $table->addColumn('actions', '&nbsp;');

        $table->editColumn('actions', function ($row) {
            $viewGate = 'user_show';
            $editGate = 'user_edit';

            $crudRoutePart = 'safes';

            return view('partials.datatablesActions', compact(
            // 'viewGate',
            'editGate',
            // 'deleteGate',
            'crudRoutePart',
            'row'
        ));
        });

        $table->editColumn('id', function ($row) {
            return $row->id ? $row->id : '';
        });
        $table->editColumn('name', function ($row) {
            return $row->name ? $row->name : '';
        });
        $table->editColumn('type', function ($row) {
            return $row->type ? $row->type : '';
        });
        $table->editColumn('value', function ($row) {
            return $row->value ? $row->value : '';
        });


        $table->rawColumns(['actions', 'placeholder', 'roles']);

        return $table->make(true);
    }

        $flag=1;
        return view('admin.Safe.index',compact('flag'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $flag=1;

        return view('admin.Safe.create',compact('flag'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SafeRequest $request)
    {
        // return $request;
        Safe::create([
            'value'=>$request->balance,
            'name'=>$request->name,
            'type'=>$request->type
        ]);
        return redirect()->route('safes.index')->with('success',"Safe Created Successfully");

    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // return $request;
        $safe=Safe::findOrFail($id);
        $flag=1;
        return view('admin.Safe.edit',compact('safe','flag'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SafeRequest $request, string $id)
    {
        Safe::findOrFail($id)->update([
            'value'=>$request->balance,
            'name'=>$request->name,
            'type'=>$request->type
        ]);
        return redirect()->route('safes.index')->with('success',"Safe Updated Successfully");

    }


    public function transactions($id){

        $safe_transactions=Safe::with(['transactions'=>function($q){
            $q->with('user');
        }])->findOrFail($id);

        //  $safe_transactions=$safe->transactions;
        $user=User::class;
        $flag=1;

        return view('admin.Safe.transaction',compact('flag','safe_transactions','user'));
        // return "f";
    }
public function safe_transfer_create(){
    $safes=Safe::all();
    $flag=1;
    return view('admin.Safe.Transafers.create',compact('safes','flag'));
}

public function destroy($id){
    $safe=Safe::findOrFail($id);
    if($safe->transactions->count()>0){
        return redirect()->back()->withErrors('لا يمكن حذف هذه الخزنه ');
    }
    else{
        $safe->delete();
        return redirect()->route('safes.index')->with('message',"Success");

    }
}

public function safe_transfer_store(SafeTransferRequest $request){

    $safe_from=Safe::find($request->safe_from);

    $safe_to=Safe::find($request->safe_to);

    $safe=(new SafeActions($request['safe_from'],"transfer $request->ammount from safe $safe_from->name to safe $safe_to->name ",$request['amount'],Safe::class,$request['safe_to']));

    $safe=$safe->transfer($safe_to);
    return redirect()->route('safes.index')->with('message',"Success");
}

}
