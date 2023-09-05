@extends('layouts.admin')
@section('content')
    @include('partials.menu',[$flag])


    <div class="card">
        <div class="card-header">
            {{ __('transaction-log.logs') }}
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ __('transaction-log.id') }}
                    </th>
                    <th>
                        {{ __('transaction-log.amount') }}
                    </th>
                    <th>
                        {{ __('transaction-log.type') }}
                    </th>
                    <th>
                        {{ __('transaction-log.statement') }}
                    </th>

                    <th>
                        {{ __('transaction-log.created_at') }}
                    </th>
                    <th>
                        {{ __('transaction-log.actions') }}
                    </th>

                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ __('borrow.search') }}">
                    </td> <td>
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
                url: "{{ route('transactionLog.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({selected: true}).data(), function (entry) {
                        return entry.id
                    });

                    if (ids.length === 0) {
                        alert('{{ __('global.no_rows_selected') }}')

                        return
                    }

                    if (confirm('{{ __('global.are_you_sure') }}')) {
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
                ajax: "{{ route('transactionLog.index') }}",
                columns: [
                    {data: 'placeholder', name: 'placeholder'},
                    {data: 'id', name: 'id'},
                    {data: 'amount', name: 'amount'},
                    {data: 'type', name: 'type'},
                    {data: 'statement', name: 'statement'},
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
