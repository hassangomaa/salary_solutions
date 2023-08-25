@extends('layouts.admin')
@section('content')
    @include('partials.menu', [$flag])

    <div class="card">
        <div class="card-header">
            Edit Attendance
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("attendance.update", ['id' => $id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- Use PUT method for update --}}
                <input type="hidden" name="follow_up_id" value="{{ $id }}">

                <div class="form-group">
                    <label class="required" for="name">Employee Name</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{ $followUp->employee->name }}" readonly>
                </div>

                <div class="form-group">
                    <label class="required" for="daily_fare">Daily Fare</label>
                    <input class="form-control" type="number" name="daily_fare" id="daily_fare" value="{{$followUp->employee->daily_fare}}" readonly>
                </div>

                <div class="form-group">
                    <label class="required" for="attended_days">Attended Days</label>
                    <input class="form-control {{ $errors->has('attended_days') ? 'is-invalid' : '' }}" type="number" name="attended_days" id="attended_days" value="{{ old('attended_days', $followUp->attended_days) }}" required>
                    @if($errors->has('attended_days'))
                        <span class="text-danger">{{ $errors->first('attended_days') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label class="required" for="overtime_hour_fare">Overtime Hour Fare</label>
                    <input class="form-control" type="number" name="overtime_hour_fare" id="overtime_hour_fare" value="{{ $followUp->employee->overtime_hour_fare }}" readonly>
                </div>

                <div class="form-group">
                    <label for="extra_hours">Extra Hours</label>
                    <input class="form-control {{ $errors->has('extra_hours') ? 'is-invalid' : '' }}" type="number" name="extra_hours" id="extra_hours" value="{{ old('extra_hours', $followUp->extra_hours) }}">
                    @if($errors->has('extra_hours'))
                        <span class="text-danger">{{ $errors->first('extra_hours') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <button class="btn btn-primary" type="submit"> {{-- Change button color and label --}}
                        {{ trans('global.update') }} {{-- Change button label --}}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
