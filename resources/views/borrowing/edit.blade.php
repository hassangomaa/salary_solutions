@extends('layouts.admin')

@section('content')
    @include('partials.menu', [$flag])

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} Borrow
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('borrowing.update', $borrow->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="required" for="employee_id">Employee</label>
                    <input
                        type="text"
                        class="form-control"
                        name="employee_name"
                        id="employee_name"
                        value="{{ $borrow->employee->name }}"
                    >
                    <input type="hidden" name="employee_id" id="employee_id" value="{{ $borrow->employee->id }}">
                    <div id="employee_suggestions"></div>
                </div>
                <div class="form-group">
                    <label class="required" for="month">Month</label>
                    <input class="form-control {{ $errors->has('month') ? 'is-invalid' : '' }}" type="number" name="month" id="month" value="{{ old('month', $borrow->month) }}" required>
                    @if($errors->has('month'))
                        <span class="text-danger">{{ $errors->first('month') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="amount">Amount</label>
                    <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', $borrow->amount) }}" required>
                    @if($errors->has('amount'))
                        <span class="text-danger">{{ $errors->first('amount') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="statement">Statement</label>
                    <input class="form-control {{ $errors->has('statement') ? 'is-invalid' : '' }}" type="text" name="statement" id="statement" value="{{ old('statement', $borrow->statement) }}" required>
                    @if($errors->has('statement'))
                        <span class="text-danger">{{ $errors->first('statement') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
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
