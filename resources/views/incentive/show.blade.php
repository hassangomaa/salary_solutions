@extends('layouts.admin')

@section('content')
    @include('partials.menu', [$flag])

    <div class="card">
        <div class="card-header">
            {{ trans('borrow.show_borrow') }}
        </div>

        <div class="card-body">
            <table class="table">
                <tbody>
                <tr>
                    <th>{{ trans('borrow.employee_name') }}</th>
                    <td>{{ $borrow->employee->name }}</td>
                </tr>
                <tr>
                    <th>{{ trans('borrow.month') }}</th>
                    <td>{{ $borrow->month }}</td>
                </tr>
                <tr>
                    <th>{{ trans('borrow.amount') }}</th>
                    <td>{{ $borrow->amount }}</td>
                </tr>
                <tr>
                    <th>{{ trans('borrow.statement') }}</th>
                    <td>{{ $borrow->statement }}</td>
                </tr>
                <!-- Add more fields here -->
                </tbody>
            </table>
        </div>
    </div>
@endsection
