@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.detail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.details.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="value">{{ trans('cruds.detail.fields.value') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text" name="value" id="value" value="{{ old('value', '') }}" required>
                @if($errors->has('value'))
                    <span class="text-danger">{{ $errors->first('value') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.detail.fields.value_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_id">{{ trans('cruds.detail.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id">
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <span class="text-danger">{{ $errors->first('product') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.detail.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="variation_id">{{ trans('cruds.detail.fields.variation') }}</label>
                <select class="form-control select2 {{ $errors->has('variation') ? 'is-invalid' : '' }}" name="variation_id" id="variation_id">
                    @foreach($variations as $id => $entry)
                        <option value="{{ $id }}" {{ old('variation_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('variation'))
                    <span class="text-danger">{{ $errors->first('variation') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.detail.fields.variation_helper') }}</span>
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