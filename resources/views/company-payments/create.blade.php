@extends('layouts.admin')
@section('content')
    @include('partials.menu')
    <div class="card">
        <div class="card-header">
            {{ trans('payments.create_payments') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("companyPayments.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="amount">{{ trans('payments.amount') }}</label>
                    <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="text" name="amount" id="amount"  @if(isset($total)) value="{{ $total }}" @endif  required>
                    @if($errors->has('amount'))
                        <span class="text-danger">{{ $errors->first('amount') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="statement">{{ trans('payments.statement') }}</label>
                    <input class="form-control {{ $errors->has('statement') ? 'is-invalid' : '' }}" type="text" name="statement" id="statement"   @if(isset($reason)) value="{{ $reason }}" @endif required>
                    @if($errors->has('statement'))
                        <span class="text-danger">{{ $errors->first('statement') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="type">{{ trans('payments.type') }}</label>
                    <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                        @foreach($paymentTypes as $type)
                            <option value="{{ $type }}" selected >
                                {{ trans('payments.'.$type) }}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('type'))
                        <span class="text-danger">{{ $errors->first('type') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="type">الخزنه</label>
                    <select class="form-control {{ $errors->has('safe') ? 'is-invalid' : '' }}" name="safe" id="safe" required>
                        @foreach($safes as $safe)
                            <option value="{{ $safe->id }}" >
                                {{ $safe->name }}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('type'))
                        <span class="text-danger">{{ $errors->first('type') }}</span>
                    @endif
                </div>
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
