
<table  class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User" DIR="RTL" style="text-align:right;">
@php
    $i=1;
@endphp
    <thead>
        <tr>
            <th style="background:#c6d9f1">مسلسل</th>
            <th style="background:#c6d9f1">الخزنه </th>
            <th style="background:#c6d9f1">الرصيد</th>
            <th style="background:#c6d9f1">مدين (وارد)</th>
            <th style="background:#c6d9f1">دائن (منصرف)</th>
            <th style="background:#c6d9f1">تاريخ العمليه </th>
            <th style="background:#c6d9f1">البيان </th>
{{--            <th style="background:#c6d9f1">الاجمالي</th>--}}
{{--            <th style="background:#c6d9f1">Actions</th>--}}
        </tr>
    </thead>
    <tbody>
        @foreach ($safes_trans as $item)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ ($item->safe)?$item->safe->name:'' }}</td>
                <td>{{ $item->value }}</td>
                <td>{{ $item->deposite }}</td>
                <td>{{ $item->withdraw }}</td>
                <td>{{  $item->created_at  }}</td>
                <td>{{  $item->details  }}</td>
{{--                <td >{{ $safes_trans->sum('value') }}</td>--}}
{{--                <td>--}}
{{--                    <form method="POST" action="{{route('remove.transaction')}}" >--}}
{{--                        @csrf--}}
{{--                        <input type="hidden" name="safe_id" value="{{ $item->id }}">--}}
{{--                        <button class="btn-danger" type="submit"> Delete & Refund </button>--}}
{{--                    </form>--}}
{{--                </td>--}}
            </tr>
        @endforeach
    </tbody>
    @if(isset($safes_trans) && method_exists($safes_trans, 'links'))
        {{ $safes_trans->links("pagination::bootstrap-4") }}
    @endif

</table>
