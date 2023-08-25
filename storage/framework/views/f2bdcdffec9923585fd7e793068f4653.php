<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu', [$flag], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="card">
        <div class="card-header">
            <?php echo e(trans('employee.show_employee')); ?>

        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="<?php echo e(route('employee.index')); ?>">
                        <?php echo e(trans('global.back_to_list')); ?>

                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            <?php echo e(trans('employee.id')); ?>

                        </th>
                        <td>
                            <?php echo e($employee->id); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('employee.name')); ?>

                        </th>
                        <td>
                            <?php echo e($employee->name); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('employee.position')); ?>

                        </th>
                        <td>
                            <?php echo e($employee->position); ?>

                        </td>
                    </tr>

                    <tr>
                        <th>
                            <?php echo e(trans('employee.daily_fare')); ?>

                        </th>
                        <td>
                            <?php echo e($employee->daily_fare); ?>

                        </td>
                    </tr>

                    <tr>
                        <th>
                            <?php echo e(trans('employee.overtime_hour_fare')); ?>

                        </th>
                        <td>
                            <?php echo e($employee->overtime_hour_fare); ?>

                        </td>
                    </tr>

                    <tr>
                        <th>
                            <?php echo e(trans('employee.phone')); ?>

                        </th>
                        <td>
                            <?php echo e($employee->phone); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('employee.address')); ?>

                        </th>
                        <td>
                            <?php echo e($employee->address); ?>

                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

<script>
        $(document).ready(function() {
            $("#relationship-tabs a").click(function(e) {
                e.preventDefault();
                $(this).tab("show");
            });
        });
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/employees/show.blade.php ENDPATH**/ ?>