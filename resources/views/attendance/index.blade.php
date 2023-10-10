@extends('layouts.admin')

@section('content')
    @include('partials.menu', [$flag])

    <div class="card">
        <div class="card-header">
            {{ trans('attendance.attendance_list') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="row">

{{--                    <div class="col-md-6">--}}
{{--                        <form action="{{ route('salary_pay') }}" method="get">--}}
{{--                            <div class="row">--}}

{{--                                <input type="month" name="month"  id="month" class="form-control col-md-6" value="{{$date}}">--}}
{{--                                <button type="submet" class="btn btn-primary col-md-3" onclick="return confirmPay(event)">  دفع مرتبات </button>--}}
{{--                            </form>--}}
{{--                            <a href="{{ route('attendance.refreshData') }}" class="btn btn-success col-md-3">Refresh Data</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="col-md-6">
                        <div class="row">
                            <input type="month" name="month" id="month" class="form-control col-md-6" value="{{$date}}">
                            <button  type="button" class="btn btn-primary col-md-3" onclick="filterAttendance()">اظهار الشهر</button>
                            <button type="button" class="btn btn-primary col-md-3" onclick="return confirmPay(event)">  دفع مرتبات </button>
                        </div>
                        <br>

                        <a href="{{ route('attendance.refreshData') }}" class="btn btn-success col-md-3">Refresh Data</a>
                        <br>
                        <br>
                    </div>

                    <div class="col-md-6">
                        <p>{{ $total_attendance_houres }}: اجمالي عدد ساعات الحضور</p>
                        <p>{{ $total_extra_hours }}: اجمالي عدد الساعات الاضافيه</p>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="row">
                        <input type="number" name="days" id="days" class="form-control col-md-6" placeholder="الأيام">
                        <input type="number" name="extra_hours" id="extra_hours" class="form-control col-md-6 " placeholder="الساعات الإضافية">
                        <br>
                        <button type="button" class="btn btn-primary col-md-12 mt-1" id="addForAll" onclick="submitData()">إضافة لجميع العمال في هذا الشهر</button>

                    </div>
                </div>
            </div>

            <br>
            <button type="button" class="btn btn-danger col-md-12 mt-1" id="addForAll" onclick="removeData()">ازاله  ايام الحضور للجميع بهذا الشهر</button>

            <div class="form-group">
                <label for="search">{{ trans('global.search') }}</label>
                <input class="form-control" type="text" id="search" name="search" placeholder="{{ trans('global.search_placeholder') }}">
            </div>
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
                <thead>
                <tr>
                    <th>{{ trans('attendance.id') }}</th>
                    <th>{{ trans('attendance.name') }}</th>
                    <th>{{ trans('attendance.position') }}</th>
                    <th>{{ trans('attendance.daily_fare') }}</th>
                    <th>{{ trans('attendance.number_of_days') }}</th>
                    <th>{{ trans('attendance.set_worked_days') }}</th>
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
                        <td>{{ $followUp->employee->daily_fare }}</td>
                        <td id="attended-days-{{ $followUp->id }}">
                            {{ $followUp->attended_days }}
                            >> {{$followUp->employee->getTotalAttendedDaysForMonth($year, $month)}}
                        </td>
                        <td>
                            <input type="number" class="days-input" name="numberOfDays" data-followUp-id="{{ $followUp->id }}" placeholder="{{ trans('attendance.enter_days') }}">
                            <button class="btn btn-primary save-days-btn" data-followUp-id="{{ $followUp->id }}">{{ trans('attendance.save') }}</button>
                        </td>
                        <td>{{ $followUp->employee->overtime_hour_fare }}</td>
                        <td id="attended-hours-{{ $followUp->id }}">{{ $followUp->extra_hours }} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>

                        <td>
                            <input type="number" class="extra_days-input" name="extra_numberOFHoures" data-followUp-id="{{ $followUp->id }}" placeholder="{{ trans('extra-hours.enter_hours') }}">
                            <button class="btn btn-primary extra_save-days-btn" data-followUp-id="{{ $followUp->id }}">{{ trans('extra-hours.save') }}</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $followUps->links('vendor.pagination.bootstrap-5') }}
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



            $(function () {
                // Handle Save Button Click
                $('.datatable-User').on('click', '.extra_save-days-btn', function () {
                    console.log('ff');
                    let followUpId = $(this).attr('data-followUp-id');
                    let extra_numberOFHoures = $('.extra_days-input[data-followUp-id="' + followUpId + '"]').val();
                    console.log(followUpId,' ',extra_numberOFHoures);
                    // Perform Ajax Request
                    $.ajax({
                        url: "{{ route('extraHours.updateNumberOfHours') }}",
                        method: 'POST',
                        data: {
                            follow_up_id: followUpId,
                            number_of_hours: extra_numberOFHoures,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            // Handle success response, if needed
                            $('#attended-hours-' + followUpId).text(extra_numberOFHoures);
                            // alert('Number of hours updated successfully.');

                            $('.extra_save-days[data-followUp-id="' + followUpId + '"]').css('background-color', 'red');

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
<script>
    function confirmPay(event, date) {
        var monthValue = document.getElementById('month').value;
        var confirmation = confirm('ستقوم الان بدفع مرتبات: ' + monthValue);
        if (!confirmation) {
            event.preventDefault();
        }else{
            const selectedMonth = document.getElementById('month').value;
            const url = `{{ route('salary_pay') }}?month=${selectedMonth}`;
            window.location.href = url;


        }
    }

    function filterAttendance() {
        const selectedMonth = document.getElementById('month').value;
        const url = `{{ route('attendance.filter') }}?month=${selectedMonth}`;
        window.location.href = url;
    }
    function submitData() {
        const days = document.getElementById('days').value;
        const extraHours = document.getElementById('extra_hours').value;
        const selectedMonth = document.getElementById('month').value;
        const url = `{{ route('attendance.setDaysAndHoursForAllEmployeesBasedOnDate') }}?days=${days}&extra_hours=${extraHours}&month=${selectedMonth}`;
        window.location.href = url;
    }

    //removeData
    function removeData() {
        const selectedMonth = document.getElementById('month').value;
        const url = `{{ route('attendance.removeData') }}?month=${selectedMonth}`;
        window.location.href = url;
    }

    $(function () {
        $('#addForAll').on('click', function () {
            const selectedMonth = document.getElementById('month').value;
            const days = document.getElementById('days').value;
            const extraHours = document.getElementById('extra_hours').value

            console.log([selectedMonth,days,extraHours]);

            $.ajax({
                url: "{{ route('extraHours.updateNumberOfHours') }}",
                method: 'POST',
                data: {
                    follow_up_id: followUpId,
                    number_of_hours: extra_numberOFHoures,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#attended-hours-' + followUpId).text(extra_numberOFHoures);
                    $('.extra_save-days[data-followUp-id="' + followUpId + '"]').css('background-color', 'red');
                    console.log(response);
                },
                error: function (xhr) {
                    console.error(xhr);
                }
            });
        });
    });
</script>
    @endsection
