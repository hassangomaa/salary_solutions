<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu', [$flag], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="card">
        <div class="card-header">
            <?php echo e(trans('attendance.show_attendance')); ?>

        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="<?php echo e(route('attendance.index')); ?>">
                        <?php echo e(trans('global.back_to_list')); ?>

                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>

                    <tr>
                        <th>
                            <?php echo e(trans('attendance.name')); ?>

                        </th>
                        <td>
                            <?php echo e($followUp->employee->name); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('attendance.position')); ?>

                        </th>
                        <td>
                            <?php echo e($followUp->employee->position); ?>

                        </td>
                    </tr>

                    <tr>
                        <th>
                            <?php echo e(trans('attendance.daily_fare')); ?>

                        </th>
                        <td>
                            <?php echo e($followUp->employee->daily_fare); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('attendance.number_of_working_days')); ?>

                        </th>
                        <td>
                            <?php echo e($followUp->attended_days); ?>

                        </td>
                    </tr>

                    <tr>
                        <th>
                            <?php echo e(trans('attendance.overtime_hour_fare')); ?>

                        </th>
                        <td>
                            <?php echo e($followUp->employee->overtime_hour_fare); ?>

                        </td>
                    </tr>


                    <tr>
                        <th>
                            <?php echo e(trans('attendance.overtime_working_hours')); ?>

                        </th>
                        <td>
                            <?php echo e($followUp->extra_hours); ?>

                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#relationship-tabs a").click(function(e) {
                e.preventDefault();
                $(this).tab("show");
            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/attendance/show.blade.php ENDPATH**/ ?>