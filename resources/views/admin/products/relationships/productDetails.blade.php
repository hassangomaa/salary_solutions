<div class="m-3">

    <div class="card">
        <div class="card-header">
            {{ trans('cruds.detail.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-productDetails">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.detail.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.detail.fields.value') }}
                            </th>
                            <th>
                                {{ trans('cruds.detail.fields.product') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.price') }}
                            </th>
                            <th>
                                {{ trans('cruds.detail.fields.variation') }}
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($details as $key => $detail)
                            <tr data-entry-id="{{ $detail->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $detail->id ?? '' }}
                                </td>
                                <td>
                                    {{ $detail->value ?? '' }}
                                </td>
                                <td>
                                    {{ $detail->product->title ?? '' }}
                                </td>
                                <td>
                                    {{ $detail->product->price ?? '' }}
                                </td>
                                <td>
                                    {{ $detail->variation->name ?? '' }}
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
@can('detail_delete')
  /*let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.details.massDestroy') }}",
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
  */
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-productDetails:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
