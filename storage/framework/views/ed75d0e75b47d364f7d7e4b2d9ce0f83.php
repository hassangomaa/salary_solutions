<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header">
            <?php echo e(trans('global.create')); ?> <?php echo e(trans('cruds.company.title_singular')); ?>

        </div>

        <div class="card-body">
            <form method="POST" action="<?php echo e(route("company.store")); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label class="required" for="name">Company Name</label>
                    <input class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>" type="text" name="name" id="name" value="<?php echo e(old('name', '')); ?>" required>
                    <?php if($errors->has('name')): ?>
                        <span class="text-danger"><?php echo e($errors->first('name')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="required" for="address">Company Address</label>
                    <input class="form-control <?php echo e($errors->has('address') ? 'is-invalid' : ''); ?>" type="text" name="address" id="address" value="<?php echo e(old('address', '')); ?>" required>
                    <?php if($errors->has('address')): ?>
                        <span class="text-danger"><?php echo e($errors->first('address')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="required" for="phone">Company Phone</label>
                    <input class="form-control <?php echo e($errors->has('phone') ? 'is-invalid' : ''); ?>" type="text" name="phone" id="phone" value="<?php echo e(old('phone', '')); ?>" required>
                    <?php if($errors->has('phone')): ?>
                        <span class="text-danger"><?php echo e($errors->first('phone')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="required" for="credit">Company Credit</label>
                    <input class="form-control <?php echo e($errors->has('credit') ? 'is-invalid' : ''); ?>" type="number" name="credit" id="credit" value="<?php echo e(old('credit', '')); ?>" required>
                    <?php if($errors->has('credit')): ?>
                        <span class="text-danger"><?php echo e($errors->first('credit')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="required" for="start_month">Month Start From</label>
                    <input class="form-control <?php echo e($errors->has('start_month') ? 'is-invalid' : ''); ?>" type="number" name="start_month" id="start_month" value="<?php echo e(old('start_month', '')); ?>" required>
                    <?php if($errors->has('start_month')): ?>
                        <span class="text-danger"><?php echo e($errors->first('start_month')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="required" for="end_month">Month End At</label>
                    <input class="form-control <?php echo e($errors->has('end_month') ? 'is-invalid' : ''); ?>" type="number" name="end_month" id="end_month" value="<?php echo e(old('end_month', '')); ?>" required>
                    <?php if($errors->has('end_month')): ?>
                        <span class="text-danger"><?php echo e($errors->first('end_month')); ?></span>
                    <?php endif; ?>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/company/create.blade.php ENDPATH**/ ?>