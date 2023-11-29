
<table  class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User" DIR="RTL" style="overflow-x: scroll">
@php
    $i=1;
@endphp
    <thead>
        <tr>
            <th style="background:#c6d9f1">مسلسل</th>
            <th style="background:#c6d9f1">الاسم </th>
            <th style="background:#c6d9f1">الوظيفه</th>
            <th style="background:#c6d9f1">راتب يومي</th>
            <th style="background:#c6d9f1">خصم سكن</th>
            <th style="background:#c6d9f1">خصم غياب</th>
            <th style="background:#c6d9f1">خصم جزاءات</th>
            <th style="background:#c6d9f1">اجمالي الخصومات</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employees as $item)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->position }}</td>
                <td style="background:#92d050">{{ $item->daily_fare }}</td>
                <td>{{ ($item->deductions)?$item->deductions->sum('housing'):0 }}</td>
                <td>{{ ($item->deductions)?$item->deductions->sum('absence'):0 }}</td>
                <td>{{ ($item->deductions)?$item->deductions->sum('penalty'):0 }}</td>
                <td>{{ (($item->deductions)?$item->deductions->sum('housing'):0)+(($item->deductions)?$item->deductions->sum('absence'):0)+(($item->deductions)?$item->deductions->sum('penalty'):0) }}</td>
            </tr>
        @endforeach
    </tbody>
    @if(isset($employees) && method_exists($employees, 'links'))
        {{ $employees->links("pagination::bootstrap-4") }}
    @endif

</table>
