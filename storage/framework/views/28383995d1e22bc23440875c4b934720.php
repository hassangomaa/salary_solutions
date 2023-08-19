<div class="m-3">

        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="<?php echo e(route('admin.products.create')); ?>">
                    <?php echo e(trans('global.add')); ?> <?php echo e(trans('cruds.product.title_singular')); ?>

                </a>
            </div>
        </div>

    <div class="card">
        <div class="card-header">
            <?php echo e(trans('cruds.product.title_singular')); ?> <?php echo e(trans('global.list')); ?>

        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-sellerProducts">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                <?php echo e(trans('cruds.product.fields.id')); ?>

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
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $commissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $commission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr data-entry-id="<?php echo e($commission->id); ?>">
                                <td>

                                </td>
                                <td>
                                    <?php echo e($commission->id ?? ''); ?>

                                </td>
                                <td>
                                    <?php echo e($commission->amount ?? ''); ?>

                                </td>
                                <td>
                                    <?php echo e($commission->reason ?? ''); ?>

                                </td>
                                <td>
                                    <?php echo e($commission->created_at ?? ''); ?>

                                </td>

                                <td>

                                        <a class="btn btn-xs btn-primary" href="<?php echo e(route('admin.products.show', $commission->id)); ?>">
                                            <?php echo e(trans('global.view')); ?>

                                        </a>



                                        <a class="btn btn-xs btn-info" href="<?php echo e(route('admin.products.edit', $commission->id)); ?>">
                                            <?php echo e(trans('global.edit')); ?>

                                        </a>



                                        <form action="<?php echo e(route('admin.products.destroy', $commission->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(trans('global.areYouSure')); ?>');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                            <input type="submit" class="btn btn-xs btn-danger" value="<?php echo e(trans('global.delete')); ?>">
                                        </form>


                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->startSection('scripts'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('scripts'); ?>
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product_delete')): ?>
  let deleteButtonTrans = '<?php echo e(trans('global.datatables.delete')); ?>'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "<?php echo e(route('admin.products.massDestroy')); ?>",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('<?php echo e(trans('global.datatables.zero_selected')); ?>')

        return
      }

      if (confirm('<?php echo e(trans('global.areYouSure')); ?>')) {
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
<?php endif; ?>

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
    bDestroy: false

});
  let table = $('.datatable-sellerProducts:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
<?php $__env->stopSection(); ?>
<?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/employees/relationships/addCommission.blade.php ENDPATH**/ ?>