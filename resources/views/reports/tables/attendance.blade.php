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
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->position }}</td>
                        <td>{{ $item->daily_fare }}</td>
                        @foreach ($period as $date)
                        <td></td>
                        @endforeach
                    </tr>
                    @endforeach
                </thead>
                <tbody>


                </tbody>
            </table>
