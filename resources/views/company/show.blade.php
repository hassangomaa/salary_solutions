@extends('layouts.admin')
@section('content')
    @include('partials.menu',[$flag])


    <div class="card">
        <div class="card-header">
          Show Company Details
        </div>

        <div class="card-body">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('company.indexBlade') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <div class="form-group">
                <label for="name">Company Name</label>
                <input class="form-control" type="text" name="name" id="name" value="{{ $company->name }}" readonly>
            </div>
            <div class="form-group">
                <label for="address">Company Address</label>
                <input class="form-control" type="text" name="address" id="address" value="{{ $company->address }}" readonly>
            </div>
            <div class="form-group">
                <label for="phone">Company Phone</label>
                <input class="form-control" type="text" name="phone" id="phone" value="{{ $company->phone }}" readonly>
            </div>
            <div class="form-group">
                <label for="credit">Company Credit</label>
                <input class="form-control" type="number" name="credit" id="credit" value="{{ $company->credit }}" readonly>
            </div>
        </div>
    </div>

@endsection
