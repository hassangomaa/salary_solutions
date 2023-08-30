<div class="m-3">
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('deduction.create', $employeeId) }}">
                Add Deduction
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Deduction List
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable datatable-sellerProducts">
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
                    @foreach($deductions as $key => $deduction)
                        <tr data-entry-id="{{ $deduction->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $deduction->id ?? '' }}
                            </td>
                            <td>
                                {{ $deduction->amount ?? '' }}
                            </td>
                            <td>
                                {{ $deduction->reason ?? '' }}
                            </td>
                            <td>
                                {{ $deduction->created_at ?? '' }}
                            </td>

                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('deduction.show', $deduction->id) }}">
                                    {{ trans('global.view') }}
                                </a>
                                <a class="btn btn-xs btn-info" href="{{ route('deduction.edit', $deduction->id) }}">
                                    {{ trans('global.edit') }}
                                </a>
                                <form action="{{ route('deduction.destroy', $deduction->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    @method('DELETE')
                                    @csrf
                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                </form>
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
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);
            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [[1, 'desc']],
                pageLength: 100,
                bDestroy: true,
            });
            let table = $('.datatable-sellerProducts:not(.ajaxTable)').DataTable({ buttons: dtButtons });
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });
        });
    </script>
@endsection
