<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu',[$flag], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="card">
        <div class="card-header">
            <?php echo e(trans('global.create')); ?> <?php echo e(trans('cruds.user.title_singular')); ?>

        </div>

        <div class="card-body">
            <form method="POST" action="<?php echo e(route("employee.store")); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label class="required" for="name">Employee Name</label>
                    <input class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>" type="text" name="name" id="name" value="<?php echo e(old('name', '')); ?>" required>
                    <?php if($errors->has('name')): ?>
                        <span class="text-danger"><?php echo e($errors->first('name')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="required" for="position">Employee Position</label>
                    <input class="form-control <?php echo e($errors->has('position') ? 'is-invalid' : ''); ?>" type="text" name="position" id="position" value="<?php echo e(old('position', '')); ?>" required>
                    <?php if($errors->has('position')): ?>
                        <span class="text-danger"><?php echo e($errors->first('position')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="required" for="daily_fare">Daily Fare</label>
                    <input class="form-control <?php echo e($errors->has('daily_fare') ? 'is-invalid' : ''); ?>" type="number" name="daily_fare" id="daily_fare" value="<?php echo e(old('daily_fare', '')); ?>" required>
                    <?php if($errors->has('daily_fare')): ?>
                        <span class="text-danger"><?php echo e($errors->first('daily_fare')); ?></span>
                    <?php endif; ?>
                </div>    <div class="form-group">
                    <label class="required" for="overtime_hour_fare"> Overtime Hour Fare</label>
                    <input class="form-control <?php echo e($errors->has('overtime_hour_fare') ? 'is-invalid' : ''); ?>" type="number" name="overtime_hour_fare" id="overtime_hour_fare" value="<?php echo e(old('overtime_hour_fare', '')); ?>" required>
                    <?php if($errors->has('overtime_hour_fare')): ?>
                        <span class="text-danger"><?php echo e($errors->first('overtime_hour_fare')); ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label class="required" for="phone">Employee Phone</label>
                    <input class="form-control <?php echo e($errors->has('phone') ? 'is-invalid' : ''); ?>" type="text" name="phone" id="phone" value="<?php echo e(old('phone', '')); ?>">
                    <?php if($errors->has('phone')): ?>
                        <span class="text-danger"><?php echo e($errors->first('phone')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="required" for="address">Employee Address</label>
                    <textarea class="form-control <?php echo e($errors->has('address') ? 'is-invalid' : ''); ?>" name="address" id="address"><?php echo e(old('address')); ?></textarea>
                    <?php if($errors->has('address')): ?>
                        <span class="text-danger"><?php echo e($errors->first('address')); ?></span>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/employees/create.blade.php ENDPATH**/ ?>