@extends('layouts.admin')

@section('content')
    @include('partials.menu')
    <div class="card">
        <div class="card-header">
            {{ trans('payments.deposit_details') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('companyPayments.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('payments.id') }}
                        </th>
                        <td>
                            {{ $deposit->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('payments.amount') }}
                        </th>
                        <td>
                            {{ $deposit->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('payments.statement') }}
                        </th>
                        <td>
                            {{ $deposit->statement }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('payments.type') }}
                        </th>
                        <td>
                            {{ $deposit->type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('payments.company_name') }}
                        </th>
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
