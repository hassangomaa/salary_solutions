@extends('layouts.admin')
@section('content')
    @include('partials.menu',[$flag])


    <div class="card">
        <div class="card-header">
            Borrowing List
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
                <thead>
                <!-- Table Header Columns -->
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Week 1</th>
                    <th>Week 2</th>
                    <th>Week 3</th>
                    <th>Week 4</th>
                    <th>Actions</th>
                    {{--                    <th>Actions</th>--}}
                </tr>
                </thead>
                <tbody>
                <!-- Loop through companies -->
                @foreach($followUps as $followUp)
                    <tr>

                        <td>{{ $followUp->employee->name }}</td>
                        <td>{{ $followUp->employee->position }}</td>
                        <td><input type="number" class="week-input" id="week1_{{$followUp->id}}" data-week="1" value="{{ $followUp->borrow_week_one }}"></td>
                        <td><input type="number" class="week-input" id="week2_{{$followUp->id}}" data-week="2" value="{{ $followUp->borrow_week_two }}"></td>
                        <td><input type="number" class="week-input" id="week3_{{$followUp->id}}" data-week="3" value="{{ $followUp->borrow_week_three }}"></td>
                        <td><input type="number" class="week-input" id="week4_{{$followUp->id}}" data-week="4" value="{{ $followUp->borrow_week_four }}"></td>
                        <td>
                            <button class="btn btn-primary save-days-btn" data-followUp-id="{{ $followUp->id }}">Save</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(function () {
            // Handle Save Button Click
            $('.datatable-User').on('click', '.save-days-btn', function () {
                // const followUpId = $(this).data('followUp-id');
            // const followUpId = $(this).attr('.followUp').val()

                const followUpId = $(this).attr('data-followUp-id');

                const weeksData = {};

                // console.log('follow up '+followUpId )

                const week1Value = $('#week1_' + followUpId).val();
                const week2Value = $('#week2_' + followUpId).val();
                const week3Value = $('#week3_' + followUpId).val();
                const week4Value = $('#week4_' + followUpId).val();


                console.log('Week 1:', week1Value);
                console.log('Week 2:', week2Value);
                console.log('Week 3:', week3Value);
                console.log('Week 4:', week4Value);
                // Perform Ajax Request
                $.ajax({
                    url: "{{ route('borrowing.store') }}",
                    method: 'POST',
                    data: {
                        follow_up_id: followUpId,
                        week1: week1Value,
                        week2: week2Value,
                        week3: week3Value,
                        week4: week4Value,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        // Handle success response, if needed
                        alert('Data saved successfully.');

                        console.log(response);
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
