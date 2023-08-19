<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="card">
        <div class="card-header">
            <?php echo e(trans('global.view')); ?> Deduction
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="<?php echo e(route('employee.show',$deduction->employee_id)); ?>">
                        <?php echo e(trans('global.back_to_list')); ?>

                    </a>
                </div>
                <label for="amount">Amount</label>
                <input class="form-control" type="text" id="amount" value="<?php echo e($deduction->amount); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="reason">Reason</label>
                <input class="form-control" type="text" id="reason" value="<?php echo e($deduction->reason); ?>" readonly>
            </div>
            <!-- Add other fields based on your schema -->

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/deduction/show.blade.php ENDPATH**/ ?>