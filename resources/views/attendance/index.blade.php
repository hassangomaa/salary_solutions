@extends('layouts.admin')
@section('content')
    @include('partials.menu', [$flag])

    <div class="card">
        <div class="card-header">
            {{ trans('attendance.attendance_list') }}
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
                <thead>
                <tr>
                    <th>{{ trans('attendance.id') }}</th>
                    <th>{{ trans('attendance.name') }}</th>
                    <th>{{ trans('attendance.position') }}</th>
                    <th>{{ trans('attendance.daily_fare') }}</th>
                    <th>{{ trans('attendance.number_of_days') }}</th>
                    <th>{{ trans('attendance.set_worked_days') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($followUps as $followUp)
                    <tr>
                        <td>{{ $followUp->id }}</td>
                        <td>{{ $followUp->employee->name }}</td>
                        <td>{{ $followUp->employee->position }}</td>
                        <td>{{ $followUp->employee->daily_fare }}</td>
                        <td id="attended-days-{{ $followUp->id }}">{{ $followUp->attended_days }}</td>
                        <td>
                            <input type="number" class="days-input" name="numberOfDays" data-followUp-id="{{ $followUp->id }}" placeholder="{{ trans('attendance.enter_days') }}">
                            <button class="btn btn-primary save-days-btn" data-followUp-id="{{ $followUp->id }}">{{ trans('attendance.save') }}</button>
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
