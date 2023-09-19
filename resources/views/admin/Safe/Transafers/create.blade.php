@extends('layouts.admin')
@section('content')
    @include('partials.menu',[$flag])

<div class="card">
    <div class="card-header">
        تحويلات بين الخزن
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("safes.safe_transfer_store") }}" >
            @csrf
            {{-- safe_from  --}}
            <div class="form-group">
                <label class="required" for="name">من خزنه</label>
                <select name="safe_from" id=""class="form-control {{ $errors->has('safe_from') ? 'is-invalid' : '' }}">
                    @foreach ($safes as $safe)
                        <option value="{{ $safe->id }}">{{ $safe->name ." ".$safe->value}}</option>
                    @endforeach
                </select>
                @if($errors->has('safe_from'))
                    <span class="text-danger">{{ $errors->first('safe_from') }}</span>
                @endif
            </div>
            {{-- safe_to  --}}
            <div class="form-group">
                <label class="required" for="name">الي خزنه</label>
                <select name="safe_to" id=""class="form-control {{ $errors->has('safe_to') ? 'is-invalid' : '' }}">
                    @foreach ($safes as $safe)
                        <option value="{{ $safe->id }}">{{ $safe->name ." ".$safe->value}}</option>
                    @endforeach
                </select>
                @if($errors->has('safe_to'))
                    <span class="text-danger">{{ $errors->first('safe_to') }}</span>
                @endif
            </div>
            {{-- safe ammount --}}
            <div class="form-group">
                <label class="required" for="balance">{{ trans('cruds.safe.fields.balance') }}</label>
                <input class="form-control {{ $errors->has('ammount') ? 'is-invalid' : '' }}" type="text" name="ammount" id="ammount" value="{{ old('ammount', '') }}" required>
                @if($errors->has('ammount'))
                    <span class="text-danger">{{ $errors->first('ammount') }}</span>
                @endif
                {{-- <span class="help-block">{{ trans('cruds.safe.fields.type') }}</span> --}}
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
