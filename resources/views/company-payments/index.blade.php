@extends('layouts.admin')
@section('content')
    @include('partials.menu')
    {{--@can('user_create')--}}
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-lg-2">
            <a class="btn btn-success" href="{{ route('companyPayments.create') }}">
                {{ trans('payments.add_payment') }}
            </a>
        </div>
        <div class="col-lg-6">
            <a class="btn btn-success" href="#">
                {{ trans('payments.current_credit') }} = {{(isset($company))?$company->credit:0}}
            </a>
        </div>
    </div>
    {{--@endcan--}}
    <div class="card">
        <div class="card-header">
            {{ trans('payments.deposits_list') }}
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('payments.id') }}
                    </th>
                    <th>
                        {{ trans('payments.amount') }}
                    </th>
                    <th>
                        {{ trans('payments.statement') }}
                    </th>
                    <th>
                        {{ trans('payments.type') }}
                    </th>
                    <th>
                        {{ trans('payments.created_at') }}
                    </th>
                    <th>
                        {{ trans('payments.actions') }}
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('payments.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('payments.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('payments.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($paymentTypes as $type)
                                <option value="{{$type}}">{{$type}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('payments.search') }}">
                    </td>
                    <td>
                        &nbsp;
                    </td>
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
            let deleteButtonTrans = '{{ trans('payments.delete_selected') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('companyPayments.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({selected: true}).data(), function (entry) {
                        return entry.id
                    });
                    if (ids.length === 0) {
                        alert('{{ trans('global.no_rows_selected') }}')
                        return
                    }
                    if (confirm('{{ trans('global.are_you_sure') }}')) {
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
                ajax: "{{ route('companyPayments.index') }}",
                columns: [
                    {data: 'placeholder', name: 'placeholder'},
                    {data: 'id', name: 'id'},
                    {data: 'amount', name: 'amount'},
                    {data: 'statement', name: 'statement'},
                    {data: 'type', name: 'type'},
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
