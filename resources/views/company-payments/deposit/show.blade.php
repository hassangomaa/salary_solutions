@extends('layouts.admin')

@section('content')
    @include('partials.menu')
    <div class="card">
        <div class="card-header">
         Deposit Details
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('companyPayments.deposit.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
ID                        </th>
                        <td>
                            {{ $deposit->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
Amount                        </th>
                        <td>
                            {{ $deposit->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
Statement                        </th>
                        <td>
                            {{ $deposit->statement }}
                        </td>
                    </tr>
                    <tr>
                        <th>
Type                        </th>
                        <td>
                            {{ $deposit->type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
Company Name                        </th>
                        <td>
                            {{ $deposit->company->name ?? '' }}
                        </td>
                    </tr>
                    <!-- Add more fields as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
