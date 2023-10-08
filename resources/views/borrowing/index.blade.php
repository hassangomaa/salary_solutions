@extends('layouts.admin')
@section('content')
    @include('partials.menu',[$flag])

    {{--@can('user_create')--}}
    <div style="margin-bottom: 10px;" class="row">
        {{-- {{ $query }} --}}
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('borrowing.create') }}">
                {{ __('borrow.add_borrowing') }}
            </a>
        </div>
    </div>
    {{--@endcan--}}
    <div class="card">
        <div class="card-header">
            {{ __('borrow.borrowing_list') }}
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ __('borrow.id') }}
                    </th>
                    <th>
                        {{ __('borrow.name') }}
                    </th>
                    <th>
                        {{ __('borrow.position') }}
                    </th>
                    <th>
                        {{ __('borrow.amount') }}
                    </th>
                    <th>
                        {{ __('borrow.month') }}
                    </th>
                    <th>
                        {{ __('borrow.created_at') }}
                    </th> <th>
                        {{ __('borrow.actions') }}
                    </th>

                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ __('borrow.search') }}">
                    </td>

                    <td>
                        <input class="search" type="text" placeholder="{{ __('borrow.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ __('borrow.search') }}">

                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ __('borrow.search') }}">

                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ __('borrow.search') }}">

                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ __('borrow.search') }}">

                    </td>
                    <td></td>

                </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection
@section('scripts')
    {{--    @parent--}}
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            {{--@can('user_delete')--}}
            let deleteButtonTrans = '{{ __('borrow.delete_selected') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('borrowing.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({selected: true}).data(), function (entry) {
                        return entry.id
                    });

                    if (ids.length === 0) {
                        alert('{{ __('global.no_rows_selected') }}')

                        return
                    }

                    if (confirm('هل انت متأكد انك تريد حذفهم؟, سيتم ارجاع المبلغ للخزينة مرة اخري')) {
                        $.ajax({
                            headers: {'x-csrf-token': /*_token*/ $('meta[name="csrf-token"]').attr('content')},
                            method: 'POST',
                            url: config.url,
                            data: {ids: ids, _method: 'DELETE'}
                        })
                            .done(function () {
                                location.reload()
                            })
                    }
                }
            }
            dtButtons.push(deleteButton)
            {{--@endcan--}}

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('borrowing.index') }}",
                columns: [
                    {data: 'placeholder', name: 'placeholder'},
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'position', name: 'position'},
                    {data: 'amount', name: 'amount'},
                    {data: 'month', name: 'month'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'}
                ],
                orderCellsTop: true,
                order: [[1, 'desc']],
                pageLength: 100,
            };
            let table = $('.datatable-User').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

            let visibleColumnsIndexes = null;
            $('.datatable thead').on('input', '.search', function () {
                let strict = $(this).attr('strict') || false
                let value = strict && this.value ? "^" + this.value + "$" : this.value

                let index = $(this).parent().index()
                if (visibleColumnsIndexes !== null) {
                    index = visibleColumnsIndexes[index]
                }

                table
                    .column(index)
                    .search(value, strict)
                    .draw()
            });
            table.on('column-visibility.dt', function (e, settings, column, state) {
                visibleColumnsIndexes = []
                table.columns(":visible").every(function (colIdx) {
                    visibleColumnsIndexes.push(colIdx);
                });
            })
        });

    </script>
@endsection
