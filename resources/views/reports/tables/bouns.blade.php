
<table  class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User" DIR="RTL" style="overflow-x: scroll">
@php
    $i=1;
@endphp
    <thead>
        <tr>
            <th style="background:#c6d9f1">مسلسل</th>
            <th style="background:#c6d9f1">الاسم </th>
            <th style="background:#c6d9f1">الوظيفه</th>
            <th style="background:#c6d9f1">عدد ساعات الضافي </th>
            <th style="background:#c6d9f1">سعر ساعه الاضافي</th>
            <th style="background:#c6d9f1">اجمالي  الاضافي</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employees as $item)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->position }}</td>
                <td>{{  $item->followUps->sum('extra_hours')  }}</td>
                <td >{{ $item->overtime_hour_fare }}</td>
                <td>{{  ($item->overtime_hour_fare != 0)?$item->followUps->sum('extra_hours') *$item->overtime_hour_fare:0}}</td>
            </tr>
        @endforeach
    </tbody>
    @if(isset($employees) && method_exists($employees, 'links'))
        {{ $employees->links("pagination::bootstrap-4") }}
    @endif
</table>
