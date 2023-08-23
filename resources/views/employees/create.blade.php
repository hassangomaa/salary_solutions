@extends('layouts.admin')
@section('content')
    @include('partials.menu',[$flag])

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("employee.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="name">Employee Name</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="position">Employee Position</label>
                    <input class="form-control {{ $errors->has('position') ? 'is-invalid' : '' }}" type="text" name="position" id="position" value="{{ old('position', '') }}" required>
                    @if($errors->has('position'))
                        <span class="text-danger">{{ $errors->first('position') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="daily_fare">Daily Fare</label>
                    <input class="form-control {{ $errors->has('daily_fare') ? 'is-invalid' : '' }}" type="number" name="daily_fare" id="daily_fare" value="{{ old('daily_fare', '') }}" required>
                    @if($errors->has('daily_fare'))
                        <span class="text-danger">{{ $errors->first('daily_fare') }}</span>
                    @endif
                </div>    <div class="form-group">
                    <label class="required" for="overtime_hour_fare"> Overtime Hour Fare</label>
                    <input class="form-control {{ $errors->has('overtime_hour_fare') ? 'is-invalid' : '' }}" type="number" name="overtime_hour_fare" id="overtime_hour_fare" value="{{ old('overtime_hour_fare', '') }}" required>
                    @if($errors->has('overtime_hour_fare'))
                        <span class="text-danger">{{ $errors->first('overtime_hour_fare') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label class="required" for="phone">Employee Phone</label>
                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}">
                    @if($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="address">Employee Address</label>
                    <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address">{{ old('address') }}</textarea>
                    @if($errors->has('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
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
