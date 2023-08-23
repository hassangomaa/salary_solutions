@extends('layouts.admin')
@section('content')
    @include('partials.menu', [$flag])
    <style>
        .suggestion-list {
            border: 1px solid #ccc; /* Add a border to the suggestion list */
            max-height: 150px; /* Limit the max height to control overflow */
            overflow-y: auto; /* Add vertical scrollbar if content exceeds max height */
            padding: 5px; /* Add some padding for better appearance */
            background-color: white; /* Set the background color */
        }

        .suggestion {
            padding: 5px;
            cursor: pointer;
        }

        .suggestion:hover {
            background-color: #f0f0f0; /* Highlight on hover */
        }
    </style>
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} Borrow
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('borrowing.store') }}">
                @csrf
{{--                <div class="form-group">--}}
{{--                    <label class="required" for="employee_id">Employee</label>--}}
{{--                    <select class="form-control {{ $errors->has('employee_id') ? 'is-invalid' : '' }}" name="employee_id" id="employee_id" required>--}}
{{--                        <option value="" disabled selected>Select an employee</option>--}}
{{--                        @foreach($employees as $employee)--}}
{{--                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                    @if($errors->has('employee_id'))--}}
{{--                        <span class="text-danger">{{ $errors->first('employee_id') }}</span>--}}
{{--                    @endif--}}
{{--                </div>--}}
                <div class="form-group">
                    <label class="required" for="employee_id">Employee</label>
                    <input
                        type="text"
                        class="form-control"
                        name="employee_name"
                        id="employee_name"
                        placeholder="Type employee name..."
                    >
                    <input type="hidden" name="employee_id" id="employee_id">
                    <div id="employee_suggestions"></div>
                </div>
                <div class="form-group">
                    <label class="required" for="month">Month</label>
                    <input class="form-control {{ $errors->has('month') ? 'is-invalid' : '' }}" type="number" name="month" id="month" value="{{ old('month', \Carbon\Carbon::now()->month) }}" required>
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
        $(function() {
            $("#employee_name").on("input", function() {
                var searchTerm = $(this).val();

                $.ajax({
                    url: "{{ route('employee.getAllEmployees') }}",
                    method: "GET",
                    data: { term: searchTerm },
                    success: function(response) {
                        var suggestionsHtml = "";
                        $.each(response, function(index, employee) {
                            suggestionsHtml += `<div class="suggestion" data-id="${employee.id}">${employee.name}</div>`;
                        });
                        $("#employee_suggestions").html(suggestionsHtml);
                    }
                });
            });

            // Handle suggestion click
            $(document).on("click", ".suggestion", function() {
                var employeeId = $(this).data("id");
                var employeeName = $(this).text();
                $("#employee_id").val(employeeId);
                $("#employee_name").val(employeeName);
                $("#employee_suggestions").html(""); // Clear suggestions
            });
        });
    </script>
@endsection
