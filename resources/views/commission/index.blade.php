<div class="m-3">
    {{--    @can('product_create')--}}
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('commission.create',$employeeId) }}">
              Add Commission
            </a>
        </div>
    </div>
    {{--    @endcan--}}
    <div class="card">
        <div class="card-header">
           Commission List
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-sellerProducts">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.product.fields.id') }}
                        </th>
                        <th>
                            Amount
                        </th>
                        <th>
                            Reason
                        </th>
                        <th>
                            Date
                        </th>
   <th>
                            Actions
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($commissions as $key => $commission)
                        <tr data-entry-id="{{ $commission->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $commission->id ?? '' }}
                            </td>
                            <td>
                                {{ $commission->amount ?? '' }}
                            </td>
                            <td>
                                {{ $commission->reason ?? '' }}
                            </td>
                            <td>
                                {{ $commission->created_at ?? '' }}
                            </td>

                            <td>
                                {{--                                    @can('product_show')--}}
                                <a class="btn btn-xs btn-primary" href="{{ route('commission.show', $commission->id) }}">
                                    {{ trans('global.view') }}
                                </a>
                                {{--                                    @endcan--}}

                                {{--                                    @can('product_edit')--}}
                                <a class="btn btn-xs btn-info" href="{{ route('commission.edit', $commission->id) }}">
                                    {{ trans('global.edit') }}
                                </a>
                                {{--                                    @endcan--}}

                                {{--                                    @can('product_delete')--}}
                                <form action="{{ route('commission.destroy', $commission->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                </form>
                                {{--                                    @endcan--}}

                            </td>

                        </tr>
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
                url: "{{ route('admin.products.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
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
                            data: { ids: ids, _method: 'DELETE' }})
                            .done(function () { location.reload() })
                    }
                }
            }
            dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 100,
                bDestroy: true

            });
            let table = $('.datatable-sellerProducts:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection
