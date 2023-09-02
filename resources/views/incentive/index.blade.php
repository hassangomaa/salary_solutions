@extends('layouts.admin')
@section('content')
    @include('partials.menu', [$flag])

    <div class="card">
        <div class="card-header">
            {{ trans('incentive.incentives_list') }}
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User table-responsive">
                <thead>
                <tr>
                    <th>{{ trans('incentive.id') }}</th>
                    <th>{{ trans('incentive.name') }}</th>
                    <th>{{ trans('incentive.position') }}</th>
                    <th>{{ trans('incentive.incentive') }}</th>
                    <th>{{ trans('incentive.bonus') }}</th>
                    <th>{{ trans('incentive.regularity') }}</th>
                    <th>{{ trans('incentive.gift') }}</th>
                    <th>{{ trans('incentive.set_incentives') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($incentives as $incentive)
                    <tr>
                        <td>{{ $incentive->id }}</td>
                        <td>{{ $incentive->employee->name }}</td>
                        <td>{{ $incentive->employee->position }}</td>
                        <td><input type="number" class="days-input" name="incentive" data-incentive-id="{{ $incentive->id }}" value="{{ $incentive->incentive }}"></td>
                        <td><input type="number" class="days-input" name="bonus" data-bonus-id="{{ $incentive->id }}" value="{{ $incentive->bonus }}"></td>
                        <td><input type="number" class="days-input" name="regularity" data-regularity-id="{{ $incentive->id }}" value="{{ $incentive->regularity }}"></td>
                        <td><input type="number" class="days-input" name="gift" data-gift-id="{{ $incentive->id }}" value="{{ $incentive->gift }}"></td>
                        <td>
                            <button class="btn btn-primary save-days-btn" data-incentive-id="{{ $incentive->id }}">{{ trans('incentive.set_incentives') }}</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $incentives->links('vendor.pagination.bootstrap-5') }}
    </div>
@endsection

@section('scripts')
        @parent
        <script>
            $(function () {
                $('.datatable-User').on('click', '.save-days-btn', function () {
                    const incentiveId = $(this).attr('data-incentive-id');
                    const incentive = $('[name="incentive"][data-incentive-id="' + incentiveId + '"]').val();
                    const bonus = $('[name="bonus"][data-bonus-id="' + incentiveId + '"]').val();
                    const regularity = $('[name="regularity"][data-regularity-id="' + incentiveId + '"]').val();
                    const gift = $('[name="gift"][data-gift-id="' + incentiveId + '"]').val();

                    // Perform Ajax Request
                    $.ajax({
                        url: "{{ route('incentive.addIncentives') }}", // Change this to your actual route
                        method: 'POST',
                        data: {
                            incentive_id: incentiveId,
                            incentive: incentive,
                            bonus: bonus,
                            regularity: regularity,
                            gift: gift,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            // Handle success response, if needed
                            console.log(response);
                            $('.save-days-btn[data-incentive-id="' + incentiveId + '"]').css('background-color', 'red');

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
