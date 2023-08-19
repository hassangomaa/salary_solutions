@extends('layouts.admin')
@section('content')
    @include('partials.menu')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} Deduction
        </div>

        <div class="card-body">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('employee.show',$deduction->employee_id) }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <form method="POST" action="{{ route('deduction.update', $deduction->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="required" for="amount">Amount</label>
                    <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="text" name="amount" id="amount" value="{{ old('amount', $deduction->amount) }}" required>
                    @if($errors->has('amount'))
                        <span class="text-danger">{{ $errors->first('amount') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="reason">Reason</label>
                    <input class="form-control {{ $errors->has('reason') ? 'is-invalid' : '' }}" type="text" name="reason" id="reason" value="{{ old('reason', $deduction->reason) }}" required>
                    @if($errors->has('reason'))
                        <span class="text-danger">{{ $errors->first('reason') }}</span>
                    @endif
                </div>
                <!-- Add other fields based on your schema -->
                <input type="hidden" name="employee_id" value="{{ $deduction->employee_id }}">

                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
