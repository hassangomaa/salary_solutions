<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="card">
        <div class="card-header">
            <?php echo e(trans('payments.create_payments')); ?>

        </div>

        <div class="card-body">
            <form method="POST" action="<?php echo e(route("companyPayments.store")); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label class="required" for="amount"><?php echo e(trans('payments.amount')); ?></label>
                    <input class="form-control <?php echo e($errors->has('amount') ? 'is-invalid' : ''); ?>" type="text" name="amount" id="amount" value="<?php echo e(old('amount', '')); ?>" required>
                    <?php if($errors->has('amount')): ?>
                        <span class="text-danger"><?php echo e($errors->first('amount')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="required" for="statement"><?php echo e(trans('payments.statement')); ?></label>
                    <input class="form-control <?php echo e($errors->has('statement') ? 'is-invalid' : ''); ?>" type="text" name="statement" id="statement" value="<?php echo e(old('statement', '')); ?>" required>
                    <?php if($errors->has('statement')): ?>
                        <span class="text-danger"><?php echo e($errors->first('statement')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="required" for="type"><?php echo e(trans('payments.type')); ?></label>
                    <select class="form-control <?php echo e($errors->has('type') ? 'is-invalid' : ''); ?>" name="type" id="type" required>
                        <?php $__currentLoopData = $paymentTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($type); ?>" selected >
                                <?php echo e(ucfirst($type)); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('type')): ?>
                        <span class="text-danger"><?php echo e($errors->first('type')); ?></span>
                    <?php endif; ?>
                </div>
        </div>
        <div class="form-group">
            <button class="btn btn-danger" type="submit">
                <?php echo e(trans('global.save')); ?>

            </button>
        </div>

        </form>
    </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/company-payments/create.blade.php ENDPATH**/ ?>