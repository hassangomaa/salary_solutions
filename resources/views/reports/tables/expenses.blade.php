@php
    $i=1;
@endphp
<table  class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User" DIR="RTL" style="overflow-x: scroll">
    <thead>
        <tr>
            <th style="background:#92d050"><b>مسلسل</b></th>
            <th style="background:#92d050"><b>اسم المصروف</b></th>
            <th style="background:#92d050"><b>القيمه</b></th>
            <th style="background:#92d050"><b>ملاحظات</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($expenses as $item )
        <tr>
            <td style="background:#92d050">{{ $i++ }}</td>
            <td>{{ trans('global.'.$item->type) }}</td>
            <td>{{ $item->amount }}</td>
            <td>{{ $item->statement }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
