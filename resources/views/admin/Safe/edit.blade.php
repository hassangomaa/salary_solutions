@extends('layouts.admin')
@section('content')
    @include('partials.menu',[$flag])

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.safe.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("safes.update",$safe->id) }}" >
            @csrf
            {{-- safe name --}}
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.safe.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ $safe->name}}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                {{-- <span class="help-block">{{ trans('cruds.safe.fields.name') }}</span> --}}
            </div>
            {{-- safe type --}}
            <div class="form-group">
                <label class="required" for="type">{{ trans('cruds.safe.fields.type') }}</label>
                <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" type="text" name="type" id="type" value="{{ $safe->type }}" required>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                {{-- <span class="help-block">{{ trans('cruds.safe.fields.type') }}</span> --}}
            </div>
             <div class="form-group">
                <label class="required" for="balance">{{ trans('cruds.safe.fields.balance') }}</label>
                <input class="form-control {{ $errors->has('balance') ? 'is-invalid' : '' }}" type="number"  name="balance" id="balance" value="{{ $safe->value }}" required>
                @if($errors->has('balance'))
                    <span class="text-danger">{{ $errors->first('balance') }}</span>
                @endif
                {{-- <span class="help-block">{{ trans('cruds.safe.fields.balance') }}</span> --}}
            </div>

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.edit') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
