@extends('layouts.admin')
@section('content')
    @include('partials.menu', [$flag])

    <div class="card">
        <div class="card-header">
            {{ trans('company-management.show_company_details') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('company.indexBlade') }}">
                    {{ trans('company-management.back_to_list') }}
                </a>
            </div>
            <div class="form-group">
                <label for="name">{{ trans('company-management.company_name') }}</label>
                <input class="form-control" type="text" name="name" id="name" value="{{ $company->name }}" readonly>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('company-management.company_address') }}</label>
                <input class="form-control" type="text" name="address" id="address" value="{{ $company->address }}" readonly>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('company-management.company_phone') }}</label>
                <input class="form-control" type="text" name="phone" id="phone" value="{{ $company->phone }}" readonly>
            </div>
            <div class="form-group">
                <label for="credit">{{ trans('company-management.company_credit') }}</label>
                <input class="form-control" type="number" name="credit" id="credit" value="{{ $company->credit }}" readonly>
            </div>
        </div>
    </div>

@endsection
