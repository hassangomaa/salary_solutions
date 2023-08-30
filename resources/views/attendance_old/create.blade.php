@extends('layouts.admin')
@section('content')
    @include('partials.menu', [$flag])

    <div class="card">
        <div class="card-header">
            {{ trans('attendance.add_attendance') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("attendance.store") }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="follow_up_id" value="{{ $id }}">

                <div class="form-group">
                    <label class="required" for="name">{{ trans('attendance.employee_name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ $employee->name }}" readonly>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label class="required" for="daily_fare">{{ trans('attendance.daily_fare') }}</label>
                    <input class="form-control {{ $errors->has('daily_fare') ? 'is-invalid' : '' }}" type="number" name="daily_fare" id="daily_fare" value="{{ $employee->daily_fare }}" readonly>
                    @if($errors->has('daily_fare'))
                        <span class="text-danger">{{ $errors->first('daily_fare') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label class="required" for="attended_days">{{ trans('attendance.attended_days') }}</label>
                    <input class="form-control {{ $errors->has('attended_days') ? 'is-invalid' : '' }}" type="number" name="attended_days" id="attended_days" value="{{ old('attended_days', '') }}" required>
                    @if($errors->has('attended_days'))
                        <span class="text-danger">{{ $errors->first('attended_days') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label class="required" for="overtime_hour_fare">{{ trans('attendance.overtime_hour_fare') }}</label>
                    <input class="form-control {{ $errors->has('overtime_hour_fare') ? 'is-invalid' : '' }}" type="number" name="overtime_hour_fare" id="overtime_hour_fare" value="{{ $employee->overtime_hour_fare }}" readonly>
                    @if($errors->has('overtime_hour_fare'))
                        <span class="text-danger">{{ $errors->first('overtime_hour_fare') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="extra_hours">{{ trans('attendance.extra_hours') }}</label>
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

    <div class="card">
        <div class="card-header">
            {{ trans('global.relatedData') }}
        </div>
        <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
            <li class="nav-item">
                <a class="nav-link" href="#seller_products" role="tab" data-toggle="tab">
                    Incentives
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#seller_products2" role="tab" data-toggle="tab">
                    ay7aga
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="seller_products">
                @includeIf('attendance.relationships.incentives', ['incentives' => $incentives])
            </div>
            <div class="tab-pane" role="tabpanel" id="seller_products2">
{{--                @includeIf('admin.users.relationships.sellerProducts', ['products' => $user->sellerProducts])--}}
            </div>
        </div>
    </div>

@endsection
