@extends('layouts.admin')
@section('content')
    @include('partials.menu', [$flag])

    <div class="card">
        <div class="card-header">
            {{ trans('borrow.create_borrow') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('borrowing.store') }}">
                @csrf


                <div class="form-group">
                    <label class="required" for="employee_id">{{ trans('borrow.employee') }}</label>
                    <select class="form-control {{ $errors->has('employee_id') ? 'is-invalid' : '' }}" name="employee_id" id="employee_id" required>
                        <option value="" disabled selected>{{ trans('borrow.select_employee') }}</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                        <option value="0">{{ trans('borrow.other') }}</option>
                    </select>
                    @if($errors->has('employee_id'))
                        <span class="text-danger">{{ $errors->first('employee_id') }}</span>
                    @endif
                </div>

                <div class="form-group" id="otherEmployeeContainer" style="display: none;">
                    <label class="required" for="other_employee_id">{{ trans('borrow.other_employee_id') }}</label>
                    <input type="text" class="form-control" name="other_employee_id" id="other_employee_id">
                </div>

                <div class="form-group">
                    <label class="required" for="start_month">بدايه من </label>
                    <input type="month"

                    class="form-control {{ $errors->has('start_month') ? 'is-invalid' : '' }}" name="start_month" id="start_month">
                    {{-- @if($errors->has('start_month'))
                        <span class="text-danger">{{ $errors->first('start_month') }}</span>
                    @endif --}}
                </div>
                <div class="form-group">
                    <label class="required" for="end_month">نهايه في </label>
                    <input type="month"
                     class="form-control {{ $errors->has('end_month') ? 'is-invalid' : '' }}"
                     name="end_month" id="end_month" id="end_month">
                    {{-- @if($errors->has('end_month'))
                        <span class="text-danger">{{ $errors->first('end_month') }}</span>
                    @endif --}}
                </div>
                <div class="form-group">
                    <label class="required" for="amount">{{ trans('borrow.amount') }}</label>
                    <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount') }}" required>
                    @if($errors->has('amount'))
                        <span class="text-danger">{{ $errors->first('amount') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="safe_id">االخزنه </label>
                    <select class="form-control {{ $errors->has('safe_id') ? 'is-invalid' : '' }}" name="safe_id" id="safe_id" required>
                        <option value="" disabled selected>{{ trans('borrow.select_safe') }}</option>
                        @foreach($safes as $safe)
                        <option value="{{ $safe->id }}">{{ $safe->name}}</option>
                    @endforeach
                    </select>
                    @if($errors->has('safe_id'))
                        <span class="text-danger">{{ $errors->first('safe_id') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="statement">{{ trans('borrow.statement') }}</label>
                    <input class="form-control {{ $errors->has('statement') ? 'is-invalid' : '' }}" type="text" name="statement" id="statement" value="{{ old('statement') }}" required>
                    @if($errors->has('statement'))
                        <span class="text-danger">{{ $errors->first('statement') }}</span>
                    @endif
                </div>
{{--                <div class="form-group">--}}
{{--                    <input {{ $errors->has('percentage_check') ? 'is-invalid' : '' }}" type="checkbox" name="percentage_check" id="percentage_check" value="1">--}}
{{--                    <label class="" for="percentage_check">اضافه نسبه </label>--}}

{{--                    @if($errors->has('percentage_check'))--}}
{{--                        <span class="text-danger">{{ $errors->first('percentage_check') }}</span>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--                <div class="form-group">--}}
{{--                    <label class="" for="percentage">النسبه</label>--}}
{{--                    <input class="form-control {{ $errors->has('percentage') ? 'is-invalid' : '' }}" type="number" step="any" min="1" name="percentage" id="percentage" value="{{ old('percentage') }}">--}}
{{--                    @if($errors->has('percentage'))--}}
{{--                        <span class="text-danger">{{ $errors->first('percentage') }}</span>--}}
{{--                    @endif--}}
{{--                </div>--}}
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('scripts')
    @parent
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const employeeSelect = document.getElementById("employee_id");
            const otherEmployeeContainer = document.getElementById("otherEmployeeContainer");
            const otherEmployeeInput = document.getElementById("other_employee_id");

            employeeSelect.addEventListener("change", function() {
                if (employeeSelect.value === "0") {
                    otherEmployeeContainer.style.display = "block";
                    otherEmployeeInput.setAttribute("required", "required");
                } else {
                    otherEmployeeContainer.style.display = "none";
                    otherEmployeeInput.removeAttribute("required");
                }
            });
        });
        ////////////////////////
        document.addEventListener("DOMContentLoaded", function () {
            // Get the current date
            const currentDate = new Date();

            // Get the year and month in "YYYY-MM" format
            const currentYear = currentDate.getFullYear();
            const currentMonth = String(currentDate.getMonth() + 1).padStart(2, '0'); // Add 1 to month since it's zero-based

            // Set the default value of the input field
            document.getElementById("start_month").value = `${currentYear}-${currentMonth}`;
            document.getElementById("end_month").value = `${currentYear}-${currentMonth}`;
        });
    </script>
@endsection
