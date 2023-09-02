<div class="m-3">
    @can('product_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('incentives.create') }}">
                    Add incentives
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            incentivess List
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-sellerProducts">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            ID
                        </th>
                        <th>
                            Employee Name
                        </th>
                        <th>
                            Position
                        </th>

                        <th>
                            Month
                        </th>
                        <th>
                            Year
                        </th>
                        <th>
                            Regularity
                        </th>
                        <th>
                            Bonus
                        </th>
                        <th>
                            Gift
                        </th>
                        <th>
                            incentives
                        </th>     <th>
                            Actions
                        </th>

                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($incentives as $data)
                        <tr data-entry-id="{{ $data->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $data->id ?? '' }}
                            </td>
                            <td>
                                {{ $data->employee->name ?? '' }}
                            </td>
                            <td>
                                {{ $data->employee->position ?? '' }}
                            </td>
                            <td>
                                {{ $data->month ?? '' }}
                            </td>
                            <td>
                                {{ $data->year ?? '' }}
                            </td>
                            <td>
                                {{ $data->regularity ?? 0 }}
                            </td>
                            <td>
                                {{ $data->bonus ?? 0 }}
                            </td>
                            <td>
                                {{ $data->gift ?? 0 }}
                            </td>
                            <td>
                                {{ $data->incentive ?? 0 }}
                            </td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('incentive.show',$data->id) }}">
                                    {{ trans('global.view') }}
                                </a>

                                <a class="btn btn-xs btn-info" href="{{ route('incentive.edit', $data->id) }}">
                                    {{ trans('global.edit') }}
                                </a>

                                <form action="{{ route('incentive.destroy', $data->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                </form>

                            </td>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('product_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('incentives.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({selected: true}).nodes(), function (entry) {
                        return $(entry).data('entry-id')
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')

                        return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                            headers: {'x-csrf-token': _token},
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
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [[1, 'desc']],
                pageLength: 100,
            });
            let table = $('.datatable-sellerProducts:not(.ajaxTable)').DataTable({buttons: dtButtons})
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection
