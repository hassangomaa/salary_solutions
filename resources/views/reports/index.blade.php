@extends('layouts.admin')

@section('content')
    @include('partials.menu', [$flag])

    <div class="card">
        <div class="card-header">
            {{ trans('reports.reports_list') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('company.clickToGenerateReport') }}">
                @csrf
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="month">Select Month:</label>
                        <select class="form-control" name="month" id="month">
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <!-- Add options for all 12 months -->
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="year">Select Year:</label>
                        <select class="form-control" name="year" id="year">
                            @for ($i = date('Y'); $i >= date('Y') - 10; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="invisible">Generate Report:</label>
                        <button type="submit" class="btn btn-primary btn-block">Generate Report</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
