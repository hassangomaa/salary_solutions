@extends('layouts.admin')
@section('content')
    @include('partials.menu',[$flag])

    <div class="card">
        <div class="card-header">
            Show Attendance
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
                            Name
                        </th>
                        <td>
                            {{ $followUp->employee->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Position
                        </th>
                        <td>
                            {{ $followUp->employee->position }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Daily Fare
                        </th>
                        <td>
                            {{ $followUp->employee->daily_fare }}
                        </td>
                    </tr>
     <tr>
                        <th>
                            Number Of Working Days
                        </th>
                        <td>
                            {{ $followUp->attended_days }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Overtime Hour Fare
                        </th>
                        <td>
                            {{ $followUp->employee->overtime_hour_fare }}
                        </td>
                    </tr>


                    <tr>
                        <th>
                            Overtime working hours
                        </th>
                        <td>
                            {{ $followUp->extra_hours }}
                        </td>
                    </tr>

                    </tbody>
                </table>
                {{--                <div class="form-group">--}}
                {{--                    <a class="btn btn-default" href="{{ route('employee.index') }}">--}}
                {{--                       Go Back--}}
                {{--                    </a>--}}
                {{--                </div>--}}
            </div>
        </div>
    </div>

{{--    <div class="card">--}}
{{--        <div class="card-header">--}}
{{--            {{ trans('global.relatedData') }}--}}
{{--        </div>--}}
{{--        <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link active" href="#commissions" role="tab" data-toggle="tab">--}}
{{--                    Commissions--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="#deductions" role="tab" data-toggle="tab">--}}
{{--                    Deductions--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--        <div class="tab-content">--}}
{{--            <div class="tab-pane active" role="tabpanel" id="commissions">--}}
{{--                @includeIf('commission.index', ['commissions' => $employee->commissions,'employeeId'=>$employee->id])--}}
{{--            </div>--}}
{{--            <div class="tab-pane" role="tabpanel" id="deductions">--}}
{{--                @includeIf('deduction.index', ['deductions' => $employee->deductions,'employeeId'=>$employee->id])--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <script>
        $(document).ready(function() {
            $("#relationship-tabs a").click(function(e) {
                e.preventDefault();
                $(this).tab("show");
            });
        });
    </script>


@endsection
