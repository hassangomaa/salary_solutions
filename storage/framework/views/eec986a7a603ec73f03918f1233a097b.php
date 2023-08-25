<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu', [$flag], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="card">
        <div class="card-header">
          Add Attendance
        </div>

        <div class="card-body">
            <form method="POST" action="<?php echo e(route("attendance.store")); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="follow_up_id" value="<?php echo e($id); ?>">

                <div class="form-group">
                    <label class="required" for="name">Employee Name</label>
                    <input class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>" type="text" name="name" id="name" value="<?php echo e($employee->name); ?>" readonly>
                    <?php if($errors->has('name')): ?>
                        <span class="text-danger"><?php echo e($errors->first('name')); ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label class="required" for="daily_fare">Daily Fare</label>
                    <input class="form-control <?php echo e($errors->has('daily_fare') ? 'is-invalid' : ''); ?>" type="number" name="daily_fare" id="daily_fare" value="<?php echo e($employee->daily_fare); ?>" readonly>
                    <?php if($errors->has('daily_fare')): ?>
                        <span class="text-danger"><?php echo e($errors->first('daily_fare')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="required" for="attended_days">Attended Days</label>
                    <input class="form-control <?php echo e($errors->has('attended_days') ? 'is-invalid' : ''); ?>" type="number" name="attended_days" id="attended_days" value="<?php echo e(old('attended_days', '')); ?>" required>
                    <?php if($errors->has('attended_days')): ?>
                        <span class="text-danger"><?php echo e($errors->first('attended_days')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="required" for="overtime_hour_fare">Overtime Hour Fare</label>
                    <input class="form-control <?php echo e($errors->has('overtime_hour_fare') ? 'is-invalid' : ''); ?>" type="number" name="overtime_hour_fare" id="overtime_hour_fare" value="<?php echo e($employee->overtime_hour_fare); ?>" readonly>
                    <?php if($errors->has('overtime_hour_fare')): ?>
                        <span class="text-danger"><?php echo e($errors->first('overtime_hour_fare')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="extra_hours">Extra Hours</label>
                    <input class="form-control <?php echo e($errors->has('extra_hours') ? 'is-invalid' : ''); ?>" type="number" name="extra_hours" id="extra_hours" value="<?php echo e(old('extra_hours', '')); ?>">
                    <?php if($errors->has('extra_hours')): ?>
                        <span class="text-danger"><?php echo e($errors->first('extra_hours')); ?></span>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/attendance/create.blade.php ENDPATH**/ ?>