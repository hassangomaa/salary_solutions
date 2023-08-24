@extends('layouts.admin')
@section('content')
    @include('partials.menu',[$flag])

    <div class="card">
        <div class="card-header">
            Edit Employee
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("employee.update", [$employee->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="name">Name</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                           id="name" value="{{ old('name', $employee->name) }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="daily_fare">Daily Fare</label>
                    <input class="form-control {{ $errors->has('daily_fare') ? 'is-invalid' : '' }}" type="text"
                           name="daily_fare" id="daily_fare"
                           value="{{ old('daily_fare', $employee->daily_fare) }}" required>
                    @if($errors->has('daily_fare'))
                        <span class="text-danger">{{ $errors->first('daily_fare') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label class="required" for="overtime_hour_fare">Overtime Hour Fare</label>
                    <input class="form-control {{ $errors->has('overtime_hour_fare') ? 'is-invalid' : '' }}" type="text"
                           name="overtime_hour_fare" id="overtime_hour_fare" value="{{ old('overtime_hour_fare', $employee->overtime_hour_fare) }}"
                           required>
                    @if($errors->has('overtime_hour_fare'))
                        <span class="text-danger">{{ $errors->first('overtime_hour_fare') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="position">Position</label>
                    <input class="form-control {{ $errors->has('position') ? 'is-invalid' : '' }}" type="text"
                           name="position" id="position" value="{{ old('position', $employee->position) }}"
                           required>
                    @if($errors->has('position'))
                        <span class="text-danger">{{ $errors->first('position') }}</span>
                    @endif
                </div>


                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone"
                           id="phone" value="{{ old('phone', $employee->phone) }}">
                    @if($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address"
                              id="address">{{ old('address', $employee->address) }}</textarea>
                    @if($errors->has('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
