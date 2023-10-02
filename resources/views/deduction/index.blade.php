@extends('layouts.admin')
@section('content')
    @include('partials.menu', [$flag])

    <div class="card">
        <div class="card-header">
            {{ trans('deductions.deduction_list') }}
        </div>

        <div class="form-group">
            <a href="{{ route('deduction.refreshData') }}" class="btn btn-success">Refresh Data</a>
        </div>
        <div class="card-body">

            <div class="form-group" style="text-align: right">
                <h4>{{ $deductions->sum('housing')+$deductions->sum('penalty')+$deductions->sum('absence') }} : مجموع الخصومات</h4>
            </div>

            <div class="form-group">
                <label for="search">{{ trans('global.search') }}</label>
                <input class="form-control" type="text" id="search" name="search" placeholder="{{ trans('global.search_placeholder') }}">
            </div>
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User table-responsive">
                <thead>
                <tr>
                    <th>{{ trans('deductions.id') }}</th>
                    <th>{{ trans('deductions.name') }}</th>
                    <th>{{ trans('deductions.position') }}</th>
                    <th>{{ trans('deductions.housing') }}</th>
                    <th>{{ trans('deductions.penalty') }}</th>
                    <th>{{ trans('deductions.absence') }}</th>
                    <th>{{ trans('deductions.set_deduction') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($deductions as $deduction)
                    <tr>
                        <td>{{ $deduction->id }}</td>
                        <td>{{ $deduction->employee->name }}</td>
                        <td>{{ $deduction->employee->position }}</td>
                        <td><input type="number" class="days-input" name="housing" data-housing-id="{{ $deduction->id }}" value="{{ $deduction->housing }}"></td>
                        <td><input type="number" class="days-input" name="penalty" data-penalty-id="{{ $deduction->id }}" value="{{ $deduction->penalty }}"></td>
                        <td><input type="number" class="days-input" name="absence" data-absence-id="{{ $deduction->id }}" value="{{ $deduction->absence }}"></td>
                        <td>
                            <button class="btn btn-primary save-days-btn" data-deduction-id="{{ $deduction->id }}">{{ trans('deductions.set_deduction') }}</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $deductions->links('vendor.pagination.bootstrap-5') }}
    </div>
@endsection


@section('scripts')
        @parent
        <script>
            $(function () {
                $('.datatable-User').on('click', '.save-days-btn', function () {
                    const deductionId = $(this).attr('data-deduction-id');
                    const housing = $('[name="housing"][data-housing-id="' + deductionId + '"]').val();
                    const penalty = $('[name="penalty"][data-penalty-id="' + deductionId + '"]').val();
                    const absence = $('[name="absence"][data-absence-id="' + deductionId + '"]').val();

                    // Perform Ajax Request
                    $.ajax({
                        url: "{{ route('deduction.addDeduction') }}", // Change this to your actual route
                        method: 'POST',
                        data: {
                            deduction_id: deductionId,
                            housing: housing,
                            penalty: penalty,
                            absence: absence,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            // Handle success response, if needed
                            console.log(response);
                            $('.save-days-btn[data-deduction-id="' + deductionId + '"]').css('background-color', 'red');

                        },
                        error: function (xhr) {
                            // Handle error response, if needed
                            console.error(xhr);
                        }
                    });
                });
            });
        </script>
    @endsection
