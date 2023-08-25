<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu', [$flag], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="card">
        <div class="card-header">
            Edit Attendance
        </div>

        <div class="card-body">
            <form method="POST" action="<?php echo e(route("attendance.update", ['id' => $id])); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?> 
                <input type="hidden" name="follow_up_id" value="<?php echo e($id); ?>">

                <div class="form-group">
                    <label class="required" for="name">Employee Name</label>
                    <input class="form-control" type="text" name="name" id="name" value="<?php echo e($followUp->employee->name); ?>" readonly>
                </div>

                <div class="form-group">
                    <label class="required" for="daily_fare">Daily Fare</label>
                    <input class="form-control" type="number" name="daily_fare" id="daily_fare" value="<?php echo e($followUp->employee->daily_fare); ?>" readonly>
                </div>

                <div class="form-group">
                    <label class="required" for="attended_days">Attended Days</label>
                    <input class="form-control <?php echo e($errors->has('attended_days') ? 'is-invalid' : ''); ?>" type="number" name="attended_days" id="attended_days" value="<?php echo e(old('attended_days', $followUp->attended_days)); ?>" required>
                    <?php if($errors->has('attended_days')): ?>
                        <span class="text-danger"><?php echo e($errors->first('attended_days')); ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label class="required" for="overtime_hour_fare">Overtime Hour Fare</label>
                    <input class="form-control" type="number" name="overtime_hour_fare" id="overtime_hour_fare" value="<?php echo e($followUp->employee->overtime_hour_fare); ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="extra_hours">Extra Hours</label>
                    <input class="form-control <?php echo e($errors->has('extra_hours') ? 'is-invalid' : ''); ?>" type="number" name="extra_hours" id="extra_hours" value="<?php echo e(old('extra_hours', $followUp->extra_hours)); ?>">
                    <?php if($errors->has('extra_hours')): ?>
                        <span class="text-danger"><?php echo e($errors->first('extra_hours')); ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary" type="submit"> 
                        <?php echo e(trans('global.update')); ?> 
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/attendance/edit.blade.php ENDPATH**/ ?>