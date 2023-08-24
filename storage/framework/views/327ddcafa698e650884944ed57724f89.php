<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu', [$flag], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="card">
        <div class="card-header">
            <?php echo e(trans('global.create')); ?> Borrow
        </div>

        <div class="card-body">
            <form method="POST" action="<?php echo e(route('borrowing.store')); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label class="required" for="employee_id">Employee</label>
                    <select class="form-control <?php echo e($errors->has('employee_id') ? 'is-invalid' : ''); ?>" name="employee_id" id="employee_id" required>
                        <option value="" disabled selected>Select an employee</option>
                        <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($employee->id); ?>"><?php echo e($employee->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <option value="0">Other</option>
                    </select>
                    <?php if($errors->has('employee_id')): ?>
                        <span class="text-danger"><?php echo e($errors->first('employee_id')); ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group" id="otherEmployeeContainer" style="display: none;">
                    <label class="required" for="other_employee_id">Other Employee ID</label>
                    <input type="text" class="form-control" name="other_employee_id" id="other_employee_id">
                </div>












                <div class="form-group">
                    <label class="required" for="month">Month</label>
                    <select class="form-control <?php echo e($errors->has('month') ? 'is-invalid' : ''); ?>" name="month" id="month" required>
                        <option value="" disabled selected>Select an month</option>
                        <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($month==0): ?>
                                <?php continue; ?>
                            <?php endif; ?>
                            <option value="<?php echo e($month); ?>"><?php echo e($month); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </select>
                    <?php if($errors->has('month')): ?>
                        <span class="text-danger"><?php echo e($errors->first('month')); ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label class="required" for="amount">Amount</label>
                    <input class="form-control <?php echo e($errors->has('amount') ? 'is-invalid' : ''); ?>" type="number" name="amount" id="amount" value="<?php echo e(old('amount')); ?>" required>
                    <?php if($errors->has('amount')): ?>
                        <span class="text-danger"><?php echo e($errors->first('amount')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="required" for="statement">Statement</label>
                    <input class="form-control <?php echo e($errors->has('statement') ? 'is-invalid' : ''); ?>" type="text" name="statement" id="statement" value="<?php echo e(old('statement')); ?>" required>
                    <?php if($errors->has('statement')): ?>
                        <span class="text-danger"><?php echo e($errors->first('statement')); ?></span>
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
<?php $__env->startSection('scripts'); ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const employeeSelect = document.getElementById("employee_id");
            const otherEmployeeContainer = document.getElementById("otherEmployeeContainer");
            const otherEmployeeInput = document.getElementById("other_employee_id");

            employeeSelect.addEventListener("change", function() {
                if (employeeSelect.value === "0") {
                    otherEmployeeContainer.style.display = "block";
                    otherEmployeeInput.setAttribute("required", "required");
                } else {
                    otherEmployeeContainer.style.display = "none";
                    otherEmployeeInput.removeAttribute("required");
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/borrowing/create.blade.php ENDPATH**/ ?>