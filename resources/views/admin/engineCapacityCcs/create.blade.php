@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.engineCapacityCc.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.engine-capacity-ccs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="engine_capacity_cc">{{ trans('cruds.engineCapacityCc.fields.engine_capacity_cc') }}</label>
                <input class="form-control {{ $errors->has('engine_capacity_cc') ? 'is-invalid' : '' }}" type="text" name="engine_capacity_cc" id="engine_capacity_cc" value="{{ old('engine_capacity_cc', '') }}">
                @if($errors->has('engine_capacity_cc'))
                    <span class="text-danger">{{ $errors->first('engine_capacity_cc') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.engineCapacityCc.fields.engine_capacity_cc_helper') }}</span>
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