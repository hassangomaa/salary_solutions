@extends('layouts.admin')

@section('content')
    @include('partials.menu', [$flag])

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} Borrow
        </div>

        <div class="card-body">
            <table class="table">
                <tbody>
                <tr>
                    <th>Employee Name</th>
                    <td>{{ $borrow->employee->name }}</td>
                </tr>
                <tr>
                    <th>{{ trans('global.month') }}</th>
                    <td>{{ $borrow->month }}</td>
                </tr>
                <tr>
                    <th>{{ trans('global.amount') }}</th>
                    <td>{{ $borrow->amount }}</td>
                </tr>
                <tr>
                    <th>Statement</th>
                    <td>{{ $borrow->statement }}</td>
                </tr>
                <!-- Add more fields here -->
                </tbody>
            </table>
        </div>
    </div>
@endsection
