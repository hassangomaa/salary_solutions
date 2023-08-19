<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="card">
        <div class="card-header">
            <?php echo e(trans('global.view')); ?> Commission
        </div>

        <div class="card-body">
            <div class="form-group">
                <a class="btn btn-default" href="<?php echo e(route('employee.show',$commission->employee_id)); ?>">
                    <?php echo e(trans('global.back_to_list')); ?>

                </a>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input class="form-control" type="text" id="amount" value="<?php echo e($commission->amount); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="reason">Reason</label>
                <input class="form-control" type="text" id="reason" value="<?php echo e($commission->reason); ?>" readonly>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/commission/show.blade.php ENDPATH**/ ?>