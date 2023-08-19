@extends('layouts.admin')
@section('content')
    @include('partials.menu')
    <div class="card">
        <div class="card-header">
            {{ trans('global.view') }} Commission
        </div>

        <div class="card-body">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('employee.show',$commission->employee_id) }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input class="form-control" type="text" id="amount" value="{{ $commission->amount }}" readonly>
            </div>
            <div class="form-group">
                <label for="reason">Reason</label>
                <input class="form-control" type="text" id="reason" value="{{ $commission->reason }}" readonly>
            </div>

        </div>
    </div>
@endsection
