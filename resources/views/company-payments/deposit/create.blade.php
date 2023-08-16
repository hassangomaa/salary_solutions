@extends('layouts.admin')
@section('content')
    @include('partials.menu')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("companyPayments.deposit.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="amount">Amount</label>
                    <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="text" name="amount" id="amount" value="{{ old('amount', '') }}" required>
                    @if($errors->has('amount'))
                        <span class="text-danger">{{ $errors->first('amount') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="statement">Statement</label>
                    <input class="form-control {{ $errors->has('statement') ? 'is-invalid' : '' }}" type="text" name="statement" id="statement" value="{{ old('statement', '') }}" required>
                    @if($errors->has('statement'))
                        <span class="text-danger">{{ $errors->first('statement') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="type">Type</label>
                    <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" type="text" name="type" id="statement" value="deposit" required>

                @if($errors->has('type'))
                        <span class="text-danger">{{ $errors->first('type') }}</span>
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
