@extends('layouts.admin')
@section('content')
    @include('partials.menu',[$flag])

    <div style="margin-bottom: 10px;" class="row">
        <!-- Add Company Button -->
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('company.create') }}">
                Add Employee Attendance
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Attendance List
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
                <thead>
                <!-- Table Header Columns -->
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Number of Days</th>
                    <th>Set Worked Days</th>
{{--                    <th>Actions</th>--}}
                </tr>
                </thead>
                <tbody>
                <!-- Loop through companies -->
                @foreach($followUps as $followUp)
                    <tr>
                        <td>{{ $followUp->id }}</td>
                        <td>{{ $followUp->employee->name }}</td>
                        <td>{{ $followUp->employee->position }}</td>
                        <td  id="attended-days-{{ $followUp->id }}">{{ $followUp->attended_days }}</td>
                        <td>
                            <input type="number" class="days-input" name="numberOfDays" data-followUp-id="{{ $followUp->id }}" placeholder="Enter days">
                            <button class="btn btn-primary save-days-btn" data-followUp-id="{{ $followUp->id }}">Save</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
        @parent
        <script>
            $(function () {
                // Handle Save Button Click
                $('.datatable-User').on('click', '.save-days-btn', function () {
                    const followUpId = $(this).attr('data-followUp-id');
                    const numberOfDays = $('.days-input[data-followUp-id="' + followUpId + '"]').val();
                    console.log(followUpId,' ',numberOfDays);
                    // Perform Ajax Request
                    $.ajax({
                        url: "{{ route('attendance.updateNumberOfDays') }}",
                        method: 'POST',
                        data: {
                            follow_up_id: followUpId,
                            number_of_days: numberOfDays,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            // Handle success response, if needed
                            $('#attended-days-' + followUpId).text(numberOfDays);

                            console.log(response);
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
