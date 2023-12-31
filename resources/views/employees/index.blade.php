@extends('layouts.admin')
@section('content')
    @include('partials.menu',[$flag])

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('employee.create') }}">
                {{ trans('employee.add_new') }}
            </a>
            <a class="btn btn-primary" href="{{route('excel.downloadImportEmployeeTemplate') }}">
                تحميل القالب
            </a>
            <a class="btn btn-info" href="{{route('employee.importEmployeesBlade') }}">
                استيراد الموظفين
            </a>

            <a class="btn btn-info" href="{{route('employee.indexTrashedOnly') }}">
                قائمة الموظفين المرحلين
            </a>

        </div>
    </div>

    <div class="card">
        <div class="card-header">
            {{ trans('employee.title') }}
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
                <thead>
                <tr>
                    <th width="10"></th>
                    <th>ID</th>
                    <th>{{ trans('employee.name') }}</th>
                    <th>{{ trans('employee.position') }}</th>
                    <th>{{ trans('employee.daily_fare') }}</th>
                    <th>{{ trans('employee.overtime_hour_fare') }}</th>
{{--                    <th>{{ trans('employee.phone') }}</th>--}}
{{--                    <th>{{ trans('employee.address') }}</th>--}}
                    <th>{{ trans('global.actions') }}</th>
                </tr>
                <tr>
                    <td></td>
                    <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                    <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                    <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                    <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
{{--                    <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>--}}
{{--                    <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>--}}
                    <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
                    <td>&nbsp;</td>
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
            let deleteButtonTrans = 'Delete Selected';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('employee.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({selected: true}).data(), function (entry) {
                        return entry.id
                    });

                    if (ids.length === 0) {
                        alert(' No Rows Selected ')

                        return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
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
                ajax: "{{ route('employee.index') }}",
                columns: [
                    {data: 'placeholder', name: 'placeholder'},
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'position', name: 'position'},
                    {data: 'daily_fare', name: 'daily_fare'},
                    {data: 'overtime_hour_fare', name: 'overtime_hour_fare'},
                    // {data: 'phone', name: 'phone'},
                    // {data: 'address', name: 'address'},
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
