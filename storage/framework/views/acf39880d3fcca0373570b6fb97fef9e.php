<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="card">
        <div class="card-header">
            <?php echo e(trans('payments.edit_payment_data')); ?>

        </div>

        <div class="card-body">
            <form method="POST" action="<?php echo e(route("companyPayments.update", $deposit->id)); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="form-group">
                    <label class="required" for="amount"><?php echo e(trans('payments.amount')); ?></label>
                    <input class="form-control <?php echo e($errors->has('amount') ? 'is-invalid' : ''); ?>" type="text" name="amount" id="amount" value="<?php echo e(old('amount', $deposit->amount)); ?>" required>
                    <?php if($errors->has('amount')): ?>
                        <span class="text-danger"><?php echo e($errors->first('amount')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="required" for="statement"><?php echo e(trans('payments.statement')); ?></label>
                    <input class="form-control <?php echo e($errors->has('statement') ? 'is-invalid' : ''); ?>" type="text" name="statement" id="statement" value="<?php echo e(old('statement', $deposit->statement)); ?>" required>
                    <?php if($errors->has('statement')): ?>
                        <span class="text-danger"><?php echo e($errors->first('statement')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="required" for="type"><?php echo e(trans('payments.type')); ?></label>
                    <select class="form-control <?php echo e($errors->has('type') ? 'is-invalid' : ''); ?>" name="type" id="type" required>
                        <option value="<?php echo e($deposit->type); ?>" selected>
                            <?php echo e(ucfirst($deposit->type)); ?>

                        </option>
                    </select>
                    <?php if($errors->has('type')): ?>
                        <span class="text-danger"><?php echo e($errors->first('type')); ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        <?php echo e(trans('global.update')); ?>

                    </button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/company-payments/edit.blade.php ENDPATH**/ ?>