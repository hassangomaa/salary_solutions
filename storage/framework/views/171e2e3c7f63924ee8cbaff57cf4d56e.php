<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu',[$flag], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="card">
        <div class="card-header">
            Edit Employee
        </div>

        <div class="card-body">
            <form method="POST" action="<?php echo e(route("employee.update", [$employee->id])); ?>" enctype="multipart/form-data">
                <?php echo method_field('PUT'); ?>
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label class="required" for="name">Name</label>
                    <input class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>" type="text" name="name"
                           id="name" value="<?php echo e(old('name', $employee->name)); ?>" required>
                    <?php if($errors->has('name')): ?>
                        <span class="text-danger"><?php echo e($errors->first('name')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="required" for="daily_fare">Daily Fare</label>
                    <input class="form-control <?php echo e($errors->has('daily_fare') ? 'is-invalid' : ''); ?>" type="text"
                           name="daily_fare" id="daily_fare"
                           value="<?php echo e(old('daily_fare', $employee->daily_fare)); ?>" required>
                    <?php if($errors->has('daily_fare')): ?>
                        <span class="text-danger"><?php echo e($errors->first('daily_fare')); ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label class="required" for="credit">Credit</label>
                    <input class="form-control <?php echo e($errors->has('credit') ? 'is-invalid' : ''); ?>" type="text"
                           name="credit" id="credit" value="<?php echo e(old('credit', $employee->credit)); ?>"
                           required>
                    <?php if($errors->has('credit')): ?>
                        <span class="text-danger"><?php echo e($errors->first('credit')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="required" for="position">Position</label>
                    <input class="form-control <?php echo e($errors->has('position') ? 'is-invalid' : ''); ?>" type="text"
                           name="position" id="position" value="<?php echo e(old('position', $employee->position)); ?>"
                           required>
                    <?php if($errors->has('position')): ?>
                        <span class="text-danger"><?php echo e($errors->first('position')); ?></span>
                    <?php endif; ?>
                </div>


                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input class="form-control <?php echo e($errors->has('phone') ? 'is-invalid' : ''); ?>" type="text" name="phone"
                           id="phone" value="<?php echo e(old('phone', $employee->phone)); ?>">
                    <?php if($errors->has('phone')): ?>
                        <span class="text-danger"><?php echo e($errors->first('phone')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control <?php echo e($errors->has('address') ? 'is-invalid' : ''); ?>" name="address"
                              id="address"><?php echo e(old('address', $employee->address)); ?></textarea>
                    <?php if($errors->has('address')): ?>
                        <span class="text-danger"><?php echo e($errors->first('address')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/hassan/AE24833A24830515/php_Projects/htdocs/projects/salary_solutions/resources/views/employees/edit.blade.php ENDPATH**/ ?>