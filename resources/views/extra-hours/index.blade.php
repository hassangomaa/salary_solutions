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
            Extra Hours List
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
                <thead>
                <!-- Table Header Columns -->
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Extra Hour Fare</th>
                    <th>Number of Extra Hours</th>
                    <th>Set Extra Hours</th>
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
                        <td>{{ $followUp->employee->overtime_hour_fare }}</td>
                        <td  id="attended-hours-{{ $followUp->id }}">{{ $followUp->extra_hours }} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
                        <td>
                            <input type="number" class="days-input" name="numberOfHours" data-followUp-id="{{ $followUp->id }}" placeholder="Enter days">
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
                    const numberOfHours = $('.days-input[data-followUp-id="' + followUpId + '"]').val();
                    console.log(followUpId,' ',numberOfHours);
                    // Perform Ajax Request
                    $.ajax({
                        url: "{{ route('extraHours.updateNumberOfHours') }}",
                        method: 'POST',
                        data: {
                            follow_up_id: followUpId,
                            number_of_hours: numberOfHours,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            // Handle success response, if needed
                            $('#attended-hours-' + followUpId).text(numberOfHours);
                            $('.save-days-btn[data-followUp-id="' + followUpId + '"]').css('background-color', 'red');

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
