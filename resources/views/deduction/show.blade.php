@extends('layouts.admin')
@section('content')
    @include('partials.menu')
    <div class="card">
        <div class="card-header">
            {{ trans('global.view') }} Deduction
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('employee.show',$deduction->employee_id) }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <label for="amount">Amount</label>
                <input class="form-control" type="text" id="amount" value="{{ $deduction->amount }}" readonly>
            </div>
            <div class="form-group">
                <label for="reason">Reason</label>
                <input class="form-control" type="text" id="reason" value="{{ $deduction->reason }}" readonly>
            </div>
            <!-- Add other fields based on your schema -->

        </div>
    </div>
@endsection
