@extends('layouts.admin')
@section('content')
    @include('partials.menu', [$flag])

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} Borrow
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('borrowing.store') }}">
                @csrf
                <div class="form-group">
                    <label class="required" for="employee_id">Employee</label>
                    <select class="form-control {{ $errors->has('employee_id') ? 'is-invalid' : '' }}" name="employee_id" id="employee_id" required>
                        <option value="" disabled selected>Select an employee</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                        <option value="0">Other</option>
                    </select>
                    @if($errors->has('employee_id'))
                        <span class="text-danger">{{ $errors->first('employee_id') }}</span>
                    @endif
                </div>

                <div class="form-group" id="otherEmployeeContainer" style="display: none;">
                    <label class="required" for="other_employee_id">Other Employee ID</label>
                    <input type="text" class="form-control" name="other_employee_id" id="other_employee_id">
                </div>
{{--                <div class="form-group">--}}
{{--                    <label class="required" for="employee_id">Employee</label>--}}
{{--                    <input--}}
{{--                        type="text"--}}
{{--                        class="form-control"--}}
{{--                        name="employee_name"--}}
{{--                        id="employee_name"--}}
{{--                        placeholder="Type employee name..."--}}
{{--                    >--}}
{{--                    <input type="hidden" name="employee_id" id="employee_id">--}}
{{--                    <div id="employee_suggestions"></div>--}}
{{--                </div>--}}
                <div class="form-group">
                    <label class="required" for="month">Month</label>
                    <select class="form-control {{ $errors->has('month') ? 'is-invalid' : '' }}" name="month" id="month" required>
                        <option value="" disabled selected>Select an month</option>
                        @foreach($months as $month)
                            @if($month==0)
                                @continue
                            @endif
                            <option value="{{ $month }}">{{ $month }}</option>
                        @endforeach

                    </select>
                    @if($errors->has('month'))
                        <span class="text-danger">{{ $errors->first('month') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label class="required" for="amount">Amount</label>
                    <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount') }}" required>
                    @if($errors->has('amount'))
                        <span class="text-danger">{{ $errors->first('amount') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="statement">Statement</label>
                    <input class="form-control {{ $errors->has('statement') ? 'is-invalid' : '' }}" type="text" name="statement" id="statement" value="{{ old('statement') }}" required>
                    @if($errors->has('statement'))
                        <span class="text-danger">{{ $errors->first('statement') }}</span>
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
@section('scripts')
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
    </script>
@endsection
