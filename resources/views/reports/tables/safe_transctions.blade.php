
<table  class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User" DIR="RTL" style="text-align:right;">
@php
    $i=1;
@endphp
    <thead>
        <tr>
            <th style="background:#c6d9f1">مسلسل</th>
            <th style="background:#c6d9f1">الاسم </th>
            <th style="background:#c6d9f1">القيمه</th>
            <th style="background:#c6d9f1">التفاصيل </th>
            <th style="background:#c6d9f1">الاجمالي</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($safes_trans as $item)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ ($item->safe)?$item->safe->name:'' }}</td>
                <td>{{ $item->value }}</td>
                <td>{{  $item->details  }}</td>
                <td >{{ $safes_trans->sum('value') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
