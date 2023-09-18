
<table  class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User" DIR="RTL" style="overflow-x: scroll">
@php
    $i=1;
@endphp
    <thead>
        <tr>
            <th style="background:#c00000">مسلسل</th>
            <th style="background:#c00000">الاسم </th>
            <th style="background:#c00000">الوظيفه</th>
            <th style="background:#c00000">حافز</th>
            <th style="background:#c00000">مكافاءه </th>
            <th style="background:#c00000">انتظام </th>
            <th style="background:#c00000">عيديه </th>
            <th style="background:#c00000"> اجمالي الحافز</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employees as $item)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->position }}</td>
                <td>{{ ($item->incentives)?$item->incentives->sum('incentive'):0 }}</td>
                <td>{{ ($item->incentives)?$item->incentives->sum('bonus'):0 }}</td>
                <td>{{ ($item->incentives)?$item->incentives->sum('regularity'):0 }}</td>
                <td>{{ ($item->incentives)?$item->incentives->sum('gift'):0 }}</td>
                <td>{{ ($item->incentives->sum('incentive'))+($item->incentives->sum('bonus'))+$item->incentives->sum('regularity')+($item->incentives->sum('gift')) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
