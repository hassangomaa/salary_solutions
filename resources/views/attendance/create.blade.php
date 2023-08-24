@extends('layouts.admin')
@section('content')
    @include('partials.menu', [$flag])

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("attendance.store") }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="hiddenField" value="{{$id}}">

                <div class="form-group">
                    <label class="required" for="name">Employee Name</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ $employee->name }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label class="required" for="daily_fare">Daily Fare</label>
                    <input class="form-control {{ $errors->has('daily_fare') ? 'is-invalid' : '' }}" type="number" name="daily_fare" id="daily_fare" value="{{$employee->daily_fare}}" required>
                    @if($errors->has('daily_fare'))
                        <span class="text-danger">{{ $errors->first('daily_fare') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="attended_days">Attended Days</label>
                    <input class="form-control {{ $errors->has('attended_days') ? 'is-invalid' : '' }}" type="number" name="attended_days" id="attended_days" value="{{ old('attended_days', '') }}" required>
                    @if($errors->has('attended_days'))
                        <span class="text-danger">{{ $errors->first('attended_days') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="overtime_hour_fare">Overtime Hour Fare</label>
                    <input class="form-control {{ $errors->has('overtime_hour_fare') ? 'is-invalid' : '' }}" type="number" name="overtime_hour_fare" id="overtime_hour_fare" value="{{ $employee->overtime_hour_fare }}" required>
                    @if($errors->has('overtime_hour_fare'))
                        <span class="text-danger">{{ $errors->first('overtime_hour_fare') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="extra_hours">Extra Hours</label>
                    <input class="form-control {{ $errors->has('extra_hours') ? 'is-invalid' : '' }}" type="number" name="extra_hours" id="extra_hours" value="{{ old('extra_hours', '') }}">
                    @if($errors->has('extra_hours'))
                        <span class="text-danger">{{ $errors->first('extra_hours') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
