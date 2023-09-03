@extends('layouts.admin')
@section('content')
    @include('partials.menu', [$flag])

    <div class="card">
        <div class="card-header">
            {{ trans('extra-hours.extra_hours_list') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <label for="search">{{ trans('global.search') }}</label>
                <input class="form-control" type="text" id="search" name="search" placeholder="{{ trans('global.search_placeholder') }}">
            </div>
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
                <thead>
                <tr>
                    <th>{{ trans('extra-hours.id') }}</th>
                    <th>{{ trans('extra-hours.name') }}</th>
                    <th>{{ trans('extra-hours.position') }}</th>
                    <th>{{ trans('extra-hours.extra_hour_fare') }}</th>
                    <th>{{ trans('extra-hours.number_of_extra_hours') }}</th>
                    <th>{{ trans('extra-hours.set_extra_hours') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($followUps as $followUp)
                    <tr>
                        <td>{{ $followUp->id }}</td>
                        <td>{{ $followUp->employee->name }}</td>
                        <td>{{ $followUp->employee->position }}</td>
                        <td>{{ $followUp->employee->overtime_hour_fare }}</td>
                        <td id="attended-hours-{{ $followUp->id }}">{{ $followUp->extra_hours }} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
                        <td>
                            <input type="number" class="days-input" name="numberOfHours" data-followUp-id="{{ $followUp->id }}" placeholder="{{ trans('extra-hours.enter_hours') }}">
                            <button class="btn btn-primary save-days-btn" data-followUp-id="{{ $followUp->id }}">{{ trans('extra-hours.save') }}</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$followUps->links('vendor.pagination.bootstrap-5')}}
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
