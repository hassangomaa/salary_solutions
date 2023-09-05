@extends('layouts.admin')
@section('content')
    @include('partials.menu', [$flag])

    <div class="card">
        <div class="card-header">
            {{ trans('transaction-log.show_company_details') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('transactionLog.index') }}">
                    {{ trans('transaction-log.back_to_list') }}
                </a>
            </div>
            <div class="form-group">
                <label for="amount">{{ trans('transaction-log.amount') }}</label>
                <input class="form-control" type="number" name="amount" id="amount" value="{{ $transaction->amount }}"
                       readonly>
            </div>

            @if(\Illuminate\Support\Facades\App::getLocale()=='en')
                <div class="form-group">
                    <label for="statement_en">{{ trans('transaction-log.statement_en') }}</label>
                    <input class="form-control" type="text" name="statement_en" id="statement_en"
                           value="{{ $transaction->statement_en }}" readonly>
                </div>
                <div class="form-group">
                    <label for="type_en">{{ trans('transaction-log.type_en') }}</label>
                    <input class="form-control" type="text" name="type_en" id="type_en"
                           value="{{ $transaction->type_en }}" readonly>
                </div>
            @else
                <div class="form-group">
                    <label for="type_ar">{{ trans('transaction-log.type_ar') }}</label>
                    <input class="form-control" type="text" name="type_ar" id="type_ar" value="{{ $transaction->type_ar }}"
                           readonly>
                </div>

                <div class="form-group">
                    <label for="statement_ar">{{ trans('transaction-log.statement_ar') }}</label>
                    <input class="form-control" type="text" name="statement_ar" id="statement_ar"
                           value="{{ $transaction->statement_ar }}" readonly>
                </div>
            @endif
        </div>
    </div>

@endsection
