@extends('layouts.admin')
@section('content')
    @include('partials.menu', [$flag])

    <div class="card">
        <div class="card-header">
            {{ trans('employee.show_employee') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('employee.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('employee.id') }}
                        </th>
                        <td>
                            {{ $employee->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('employee.name') }}
                        </th>
                        <td>
                            {{ $employee->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('employee.position') }}
                        </th>
                        <td>
                            {{ $employee->position }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('employee.daily_fare') }}
                        </th>
                        <td>
                            {{ $employee->daily_fare }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('employee.overtime_hour_fare') }}
                        </th>
                        <td>
                            {{ $employee->overtime_hour_fare }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('employee.phone') }}
                        </th>
                        <td>
                            {{ $employee->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('employee.address') }}
                        </th>
                        <td>
                            {{ $employee->address }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

<script>
        $(document).ready(function() {
            $("#relationship-tabs a").click(function(e) {
                e.preventDefault();
                $(this).tab("show");
            });
        });
    </script>


@endsection
