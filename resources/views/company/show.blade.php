@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.company.title_singular') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <label for="name">{{ trans('cruds.company.fields.name') }}</label>
                <input class="form-control" type="text" name="name" id="name" value="{{ $company->name }}" readonly>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.company.fields.address') }}</label>
                <input class="form-control" type="text" name="address" id="address" value="{{ $company->address }}" readonly>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.company.fields.phone') }}</label>
                <input class="form-control" type="text" name="phone" id="phone" value="{{ $company->phone }}" readonly>
            </div>
            <div class="form-group">
                <label for="credit">{{ trans('cruds.company.fields.credit') }}</label>
                <input class="form-control" type="number" name="credit" id="credit" value="{{ $company->credit }}" readonly>
            </div>
        </div>
    </div>

@endsection
