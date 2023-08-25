<?php

namespace App\Http\Controllers;

//use App\Http\Controllers\Controller;
//use App\Http\Requests\MassDestroyUserRequest;
//use App\Http\Requests\StoreUserRequest;
//use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
//use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    public function index(Request $request)
    {
//        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = User::select('*');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_show';
                $editGate = 'user_edit';
                $deleteGate = 'user_delete';
                $crudRoutePart = 'users';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
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
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });

//            $table->editColumn('roles', function ($row) {
//                $labels = [];
//                foreach ($row->roles as $role) {
//                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $role->title);
//                }
//
//                return implode(' ', $labels);
//            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'roles']);

            return $table->make(true);
        }

//        $roles = Role::get();
        $flag = 1;
        return view('users.index', compact(/*'roles',*/'flag'));
    }

    public function create()
    {
//        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');
        $flag = 1;

        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('users.index');
    }

    public function edit($userId)
    {
//        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');
        $user = User::find($userId);
        $flag = 1;

        return view('users.edit', compact('flag', 'user'));
    }

    public function update(Request $request, $userId)
    {
        $user = User::find($userId);
        if (isset($request->password))
        {
            $user->password =Hash::make($request->password);

        }
        unset($request['password']);
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('users.index');
    }

    public function show( $userId)
    {
//        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = User::find($userId);
        $user->load('roles'/*, 'sellerProducts'*/);
        $flag = 1;

        return view('users.show', compact('user','flag'));
    }

    public function destroy($userId)
    {
//        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = User::find($userId);

        $user->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
