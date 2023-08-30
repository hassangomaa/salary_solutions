@extends('layouts.admin')
@section('content')
    @include('partials.menu',[$flag])

{{--    <div style="margin-bottom: 10px;" class="row">--}}
{{--        <!-- Add Company Button -->--}}
{{--        <div class="col-lg-12">--}}
{{--            <a class="btn btn-success" href="{{ route('company.create') }}">--}}
{{--                Add Employee Attendance--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="card">
        <div class="card-header">
            Deduction List
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User table-responsive">
                <thead>
                <!-- Table Header Columns -->
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Housing</th>
                    <th>Penalty</th>
                    <th>Absence</th>
                    <th>Set Deduction</th>
                </tr>
                </thead>
                <tbody>
                <!-- Loop through companies -->
                @foreach($deductions as $deduction)
                    <tr>
                        <td>{{ $deduction->id }}</td>
                        <td>{{ $deduction->employee->name }}</td>
                        <td>{{ $deduction->employee->position }}</td>
                        <td>  <input type="number" class="days-input" name="housing" data-housing-id="{{ $deduction->id }}" value="{{ $deduction->housing }}"></td>
                        <td> <input type="number" class="days-input" name="penalty" data-penalty-id="{{ $deduction->id }}" value="{{ $deduction->penalty }}"></td>
                        <td><input type="number" class="days-input" name="absence" data-absence-id="{{ $deduction->id }}" value="{{ $deduction->absence }}"></td>
                        <td>
                            <button class="btn btn-primary save-days-btn" data-deduction-id="{{ $deduction->id }}">Save</button>
                        </td>


                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $deductions->links('vendor.pagination.bootstrap-5') }}
    </div>
@endsection

@section('scripts')
        @parent
        <script>
            $(function () {
                $('.datatable-User').on('click', '.save-days-btn', function () {
                    const deductionId = $(this).attr('data-deduction-id');
                    const housing = $('[name="housing"][data-housing-id="' + deductionId + '"]').val();
                    const penalty = $('[name="penalty"][data-penalty-id="' + deductionId + '"]').val();
                    const absence = $('[name="absence"][data-absence-id="' + deductionId + '"]').val();

                    // Perform Ajax Request
                    $.ajax({
                        url: "{{ route('deduction.addDeduction') }}", // Change this to your actual route
                        method: 'POST',
                        data: {
                            deduction_id: deductionId,
                            housing: housing,
                            penalty: penalty,
                            absence: absence,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            // Handle success response, if needed
                            console.log(response);
                            $('.save-days-btn[data-deduction-id="' + deductionId + '"]').css('background-color', 'red');

                        },
                        error: function (xhr) {
                            // Handle error response, if needed
                            console.error(xhr);
                        }
                    });
                });
            });
        </script>
    @endsection
