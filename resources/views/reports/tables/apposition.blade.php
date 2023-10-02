
<table  class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User" DIR="RTL" style="overflow-x: scroll">
@php
    $i=1;
@endphp
    <thead>
        <tr>
            <th style="background:#92d050">مسلسل</th>
            <th style="background:#92d050">الاسم </th>
            <th style="background:#92d050">الوظيفه</th>
        @foreach ($employees as $employee)
            @php
                $g=1;
            @endphp
            @foreach ($employee->borrows as $b)
                <th style="background:#92d050">{{ $g++ }} سلفه</th>
            @endforeach
        @endforeach
        <th style="background:#92d050">الاجمالي</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employees as $item)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->position }}</td>
                @foreach ($item->borrows as $borrow)
                    <td>{{ $borrow->amount }}</td>
                @endforeach
                <td>{{ $item->borrows->sum('amount') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
