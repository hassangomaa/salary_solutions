@extends('layouts.admin')
@section('content')
@can('image_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.images.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.image.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.image.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Image">
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
                        <th>
                            &nbsp;
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

                                @can('image_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.images.edit', $image->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('image_delete')
                                    <form action="{{ route('admin.images.destroy', $image->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)


  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Image:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
