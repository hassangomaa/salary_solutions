@extends('layouts.admin')

@section('content')
    @include('partials.menu', [$flag])

    {{--@can('user_create')--}}
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('safes.create') }}">
                {{ __('cruds.safe.create') }}
            </a>
        </div>
    </div>
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-info  " href="{{ route('safes.safe_transfer.create') }}">
                تحويلات بين الخزن
            </a>
        </div>
    </div>
    {{--  --}}
    {{--@endcan--}}
    <div class="card">
        <div class="card-header">
            {{ __('cruds.safe.create') }}
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>{{ __('cruds.safe.fields.id') }}</th>
                        <th>{{ __('cruds.safe.fields.name') }}</th>
                        <th>{{ __('cruds.safe.fields.balance') }}</th>
                        <th>{{ __('cruds.safe.fields.type') }}</th>
                        {{-- <th>{{ __('borrow.month') }}</th> --}}
                        <th>{{ __('borrow.created_at') }}</th>
                        <th>{{ __('borrow.actions') }}</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>
                            <input id="searchId" class="form-control form-control-sm" type="text" placeholder="{{ __('borrow.search') }}">
                        </th>
                        <th>
                            <input id="searchName" class="form-control form-control-sm" type="text" placeholder="{{ __('borrow.search') }}">
                        </th>
                        <th>
                            <input id="searchPosition" class="form-control form-control-sm" type="text" placeholder="{{ __('borrow.search') }}">
                        </th>
                        <th></th>
                        <th>
                            <input id="searchCreatedAt" class="form-control form-control-sm" type="text" placeholder="{{ __('borrow.search') }}">
                        </th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('safes.index') }}",
                columns: [
                    {data: 'placeholder', name: 'placeholder'},
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'value', name: 'value'},
                    {data: 'type', name: 'type'},
                    {data: 'created_at', name: 'created_at'},
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                        let editUrl = "{{ route('safes.edit', ':id') }}";
                        let transactionUrl = "{{ route('safes.transactions', ':id') }}";
                        let deleteUrl = "{{ route('safes.destroy', ':id') }}";
                        editUrl = editUrl.replace(':id', row.id);
                        transactionUrl = transactionUrl.replace(':id', row.id);
                        deleteUrl = deleteUrl.replace(':id', row.id);
                        return `
                            <a href="${editUrl}" class="btn btn-sm btn-primary">
                                {{ __('edit') }}
                            </a>
                            <br>
                            <a href="${transactionUrl}" class="btn btn-sm btn-success">
                                {{ __('transactions') }}
                            </a>
                            <a href="${deleteUrl}" class="btn btn-sm btn-danger">
                                {{ __('delete') }}
                            </a>
                        `;
                        }
                    }
                    ],
                orderCellsTop: true,
                order: [[1, 'desc']],
                pageLength: 100,
            };

            let table = $('.datatable-User').DataTable(dtOverrideGlobals);

            $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });

            let visibleColumnsIndexes = null;

            $('.datatable thead').on('input', '.search', function () {
                let strict = $(this).attr('strict') || false;
                let value = strict && this.value ? "^" + this.value + "$" : this.value;

                let index = $(this).closest('th').index();
                if (visibleColumnsIndexes !== null) {
                    index = visibleColumnsIndexes[index];
                }

                table.column(index).search(value, strict).draw();
            });

            table.on('column-visibility.dt', function (e, settings, column, state) {
                visibleColumnsIndexes = [];
                table.columns(":visible").every(function (colIdx) {
                    visibleColumnsIndexes.push(colIdx);
                });
            });
        });
    </script>
@endsection
