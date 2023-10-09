<table  class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User" DIR="RTL" style="overflow-x: scroll">
                <thead>
                    <tr >
                        <th colspan="34" style="text-align: center">
                            الحضور والانصراف لشهر{{ $month_name }}
                        </th>
                    </tr>
                    <tr>
                        <th>ايام الاسبوع</th>
                        <th></th>
                        <th></th>
                        @foreach ($period as $date)
                            <th>{{ \Carbon\Carbon::parse($date)->format('D') }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        <th>الاسم</th>
                        <th>المهنه</th>
                        <th>راتب يومي</th>
                        @foreach ($period as $date)
                        <th>{{ \Carbon\Carbon::parse($date)->format('d') }}</th>
                        @endforeach
                    </tr>
                    @foreach ($employees as $item)

                        <tr>


                            <td>

                                {{ $item->name }}
                            </td>
                            <td>{{ $item->position }}</td>
                            <td>{{ $item->daily_fare .'*'. $item->getAttendanceCountForMonth($year, $month)   }}</td>
                            @foreach ($period as $date)
{{--                                {{$item->getAttendanceStatus(\Carbon\Carbon::parse($date)->format('Y-m-d'))?? \Carbon\Carbon::parse($date)->format('Y-m-d')}}--}}
                                <td class="attendance-cell" data-employee-id="{{ $item->id }}" data-date="{{ \Carbon\Carbon::parse($date)->format('Y-m-d') }}">
                                    <input
                                        type="radio"
                                        name="attendance[{{ $item->id }}][{{ \Carbon\Carbon::parse($date)->format('Y-m-d') }}]"
                                        value="1"
                                        {{ $item->getAttendanceStatus(\Carbon\Carbon::parse($date)->format('Y-m-d')) == 1 ? 'checked' : '' }}> حضور
                                    <input
                                        type="radio"
                                        name="attendance[{{ $item->id }}][{{ \Carbon\Carbon::parse($date)->format('Y-m-d') }}]"
                                        value="0" {{ $item->getAttendanceStatus(\Carbon\Carbon::parse($date)->format('Y-m-d')) == 0 ? 'checked' : '' }}> غياب
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </thead>
                <tbody>
                </tbody>
            </table>

<script>
    $(document).ready(function () {
        // Add click event handler for attendance cells
        $('.attendance-cell input[type="radio"]').click(function () {
            var radioInput = $(this);
            var employeeId = radioInput.closest('.attendance-cell').data('employee-id');
            var date = radioInput.closest('.attendance-cell').data('date');
            var currentValue = radioInput.val();

            // Format the date in "Y-m-d" format
            var formattedDate = new Date(date);
            formattedDate = formattedDate.toISOString().split('T')[0]; // Extract date part

            // Send an AJAX request to save attendance data
            $.ajax({
                url: '/save-attendance',
                type: 'POST', // Use POST method for sending data
                data: {
                    _token: '{{ csrf_token() }}', // Add CSRF token for security
                    employee_id: employeeId,
                    date: formattedDate, // Send the formatted date
                    attendance_status: currentValue
                },
                success: function (response) {
                    // Handle the response
                    console.log('Attendance data saved successfully.');

                    // Update the radio input value if the response indicates a different status
                    if (response.new_status !== undefined) {
                        // Update the checked state
                        radioInput.prop('checked', response.new_status === "1");
                    }
                },
                error: function (error) {
                    // Handle errors
                    console.error('Error saving attendance data: ' + error.responseText);
                    // Reset the checked state if an error occurs
                    radioInput.prop('checked', currentValue === "1");
                }
            });
        });
    });



</script>
