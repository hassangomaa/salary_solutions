@extends('layouts.admin')
@section('content')
    @include('partials.menu')
    <div class="card">
        <div class="card-header">
            {{ trans('payments.edit_payment_data') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("companyPayments.update", $deposit->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="required" for="amount">{{ trans('payments.amount') }}</label>
                    <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="text" name="amount" id="amount" value="{{ old('amount', $deposit->amount) }}" required>
                    @if($errors->has('amount'))
                        <span class="text-danger">{{ $errors->first('amount') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="statement">{{ trans('payments.statement') }}</label>
                    <input class="form-control {{ $errors->has('statement') ? 'is-invalid' : '' }}" type="text" name="statement" id="statement" value="{{ old('statement', $deposit->statement) }}" required>
                    @if($errors->has('statement'))
                        <span class="text-danger">{{ $errors->first('statement') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="type">{{ trans('payments.type') }}</label>
                    <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                        <option value="{{ $deposit->type }}" selected>
                            {{ ucfirst($deposit->type) }}
                        </option>
                    </select>
                    @if($errors->has('type'))
                        <span class="text-danger">{{ $errors->first('type') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
