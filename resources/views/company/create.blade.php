@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.company.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("company.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="name">Company Name</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="address">Company Address</label>
                    <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}" required>
                    @if($errors->has('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="phone">Company Phone</label>
                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required>
                    @if($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="credit">Company Credit</label>
                    <input class="form-control {{ $errors->has('credit') ? 'is-invalid' : '' }}" type="number" name="credit" id="credit" value="{{ old('credit', '') }}" required>
                    @if($errors->has('credit'))
                        <span class="text-danger">{{ $errors->first('credit') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="start_month">Month Start From</label>
                    <input class="form-control {{ $errors->has('start_month') ? 'is-invalid' : '' }}" type="number" name="start_month" id="start_month" value="{{ old('start_month', '') }}" required>
                    @if($errors->has('start_month'))
                        <span class="text-danger">{{ $errors->first('start_month') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="end_month">Month End At</label>
                    <input class="form-control {{ $errors->has('end_month') ? 'is-invalid' : '' }}" type="number" name="end_month" id="end_month" value="{{ old('end_month', '') }}" required>
                    @if($errors->has('end_month'))
                        <span class="text-danger">{{ $errors->first('end_month') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
