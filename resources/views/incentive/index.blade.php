@extends('layouts.admin')
@section('content')
    @include('partials.menu',[$flag])

{{--    <div style="margin-bottom: 10px;" class="row">--}}
{{--        <!-- Add Company Button -->--}}
{{--        <div class="col-lg-12">--}}
{{--            <a class="btn btn-success" href="{{ route('company.create') }}">--}}
{{--                Add Employee Attendance--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="card">
        <div class="card-header">
           Incentives List
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User table-responsive">
                <thead>
                <!-- Table Header Columns -->
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>incentive</th>
                    <th>bonus</th>
                    <th>regularity</th>
                    <th>gift</th>
                    <th>Set Incentives</th>
                </tr>
                </thead>
                <tbody>
                <!-- Loop through companies -->
                @foreach($incentives as $incentive)
                    <tr>
                        <td>{{ $incentive->id }}</td>
                        <td>{{ $incentive->employee->name }}</td>
                        <td>{{ $incentive->employee->position }}</td>
                        <td>  <input type="number" class="days-input" name="incentive" data-incentive-id="{{ $incentive->id }}" value="{{ $incentive->incentive }}"></td>
                        <td> <input type="number" class="days-input" name="bonus" data-bonus-id="{{ $incentive->id }}" value="{{ $incentive->bonus }}"></td>
                        <td><input type="number" class="days-input" name="regularity" data-regularity-id="{{ $incentive->id }}" value="{{ $incentive->regularity }}"></td>
                        <td><input type="number" class="days-input" name="gift" data-gift-id="{{ $incentive->id }}" value="{{ $incentive->gift }}"></td>
{{--                    --}}
                        <td>
                            <button class="btn btn-primary save-days-btn" data-incentive-id="{{ $incentive->id }}">Save</button>
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
