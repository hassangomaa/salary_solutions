@extends('layouts.admin')
@section('content')
    @include('partials.menu', [$flag])

    <div class="card">
        <div class="card-header">
            {{ trans('attendance.show_attendance') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('attendance.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>

                    <tr>
                        <th>
                            {{ trans('attendance.name') }}
                        </th>
                        <td>
                            {{ $followUp->employee->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('attendance.position') }}
                        </th>
                        <td>
                            {{ $followUp->employee->position }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('attendance.daily_fare') }}
                        </th>
                        <td>
                            {{ $followUp->employee->daily_fare }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('attendance.number_of_working_days') }}
                        </th>
                        <td>
                            {{ $followUp->attended_days }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('attendance.overtime_hour_fare') }}
                        </th>
                        <td>
                            {{ $followUp->employee->overtime_hour_fare }}
                        </td>
                    </tr>


                    <tr>
                        <th>
                            {{ trans('attendance.overtime_working_hours') }}
                        </th>
                        <td>
                            {{ $followUp->extra_hours }}
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {
            $("#relationship-tabs a").click(function(e) {
                e.preventDefault();
                $(this).tab("show");
            });
        });
    </script>

@endsection
