<div class="m-3">

    <div class="card">
        <div class="card-header">
            {{ trans('cruds.image.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-productImages">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.image.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.image.fields.product') }}
                            </th>
                            <th>
                                {{ trans('cruds.image.fields.photo') }}
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($images as $key => $image)
                            <tr data-entry-id="{{ $image->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $image->id ?? '' }}
                                </td>
                                <td>
                                    {{ $image->product->title ?? '' }}
                                </td>
                                <td>
                                    @if($image->photo)
                                        <a href="{{ config('APP_URL').$image->photo}}" target="_blank" >
                                            <img src="{{config('APP_URL').$image->photo}}" style="vertical-align: middle;border-style: none;width: 50px; !important">
                                        </a>
                                    @endif
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
@can('image_delete')
    /*let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.images.massDestroy') }}",
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
  dtButtons.push(deleteButton)*/
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-productImages:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
