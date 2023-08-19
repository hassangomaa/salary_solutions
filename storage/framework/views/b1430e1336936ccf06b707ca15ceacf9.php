<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="card">
        <div class="card-header">
            <?php echo e(trans('global.create')); ?> Commission
        </div>

        <div class="card-body">
            <div class="form-group">
                <a class="btn btn-default" href="<?php echo e(route('employee.show',$employeeId)); ?>">
                    <?php echo e(trans('global.back_to_list')); ?>

                </a>
            </div>
            <form method="POST" action="<?php echo e(route('commission.store')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label class="required" for="amount">Amount</label>
                    <input class="form-control <?php echo e($errors->has('amount') ? 'is-invalid' : ''); ?>" type="text" name="amount" id="amount" value="<?php echo e(old('amount')); ?>" required>
                    <?php if($errors->has('amount')): ?>
                        <span class="text-danger"><?php echo e($errors->first('amount')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="required" for="reason">Reason</label>
                    <input class="form-control <?php echo e($errors->has('reason') ? 'is-invalid' : ''); ?>" type="text" name="reason" id="reason" value="<?php echo e(old('reason')); ?>" required>
                    <?php if($errors->has('reason')): ?>
                        <span class="text-danger"><?php echo e($errors->first('reason')); ?></span>
                    <?php endif; ?>
                </div>
                <!-- Add other fields based on your schema -->
                <input type="hidden" name="employee_id" value="<?php echo e($employeeId); ?>">


                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        <?php echo e(trans('global.save')); ?>

                    </button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/hassan/AE24833A24830515/php_Projects/htdocs/projects/salary_solutions/resources/views/commission/create.blade.php ENDPATH**/ ?>