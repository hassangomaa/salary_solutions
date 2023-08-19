<div class="m-3">
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="<?php echo e(route('deduction.create', $employeeId)); ?>">
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
                            Actions
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $deductions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $deduction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr data-entry-id="<?php echo e($deduction->id); ?>">
                            <td>

                            </td>
                            <td>
                                <?php echo e($deduction->id ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($deduction->amount ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($deduction->reason ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($deduction->created_at ?? ''); ?>

                            </td>

                            <td>
                                <a class="btn btn-xs btn-primary" href="<?php echo e(route('deduction.show', $deduction->id)); ?>">
                                    <?php echo e(trans('global.view')); ?>

                                </a>
                                <a class="btn btn-xs btn-info" href="<?php echo e(route('deduction.edit', $deduction->id)); ?>">
                                    <?php echo e(trans('global.edit')); ?>

                                </a>
                                <form action="<?php echo e(route('deduction.destroy', $deduction->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(trans('global.areYouSure')); ?>');" style="display: inline-block;">
                                    <?php echo method_field('DELETE'); ?>
                                    <?php echo csrf_field(); ?>
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
<?php $__env->stopSection(); ?>
<?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/deduction/index.blade.php ENDPATH**/ ?>