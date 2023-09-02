<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu', [$flag], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="card">
        <div class="card-header">
            <?php echo e(trans('extra-hours.extra_hours_list')); ?>

        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
                <thead>
                <tr>
                    <th><?php echo e(trans('extra-hours.id')); ?></th>
                    <th><?php echo e(trans('extra-hours.name')); ?></th>
                    <th><?php echo e(trans('extra-hours.position')); ?></th>
                    <th><?php echo e(trans('extra-hours.extra_hour_fare')); ?></th>
                    <th><?php echo e(trans('extra-hours.number_of_extra_hours')); ?></th>
                    <th><?php echo e(trans('extra-hours.set_extra_hours')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $followUps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $followUp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($followUp->id); ?></td>
                        <td><?php echo e($followUp->employee->name); ?></td>
                        <td><?php echo e($followUp->employee->position); ?></td>
                        <td><?php echo e($followUp->employee->overtime_hour_fare); ?></td>
                        <td id="attended-hours-<?php echo e($followUp->id); ?>"><?php echo e($followUp->extra_hours); ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
                        <td>
                            <input type="number" class="days-input" name="numberOfHours" data-followUp-id="<?php echo e($followUp->id); ?>" placeholder="<?php echo e(trans('extra-hours.enter_hours')); ?>">
                            <button class="btn btn-primary save-days-btn" data-followUp-id="<?php echo e($followUp->id); ?>"><?php echo e(trans('extra-hours.save')); ?></button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
        <?php echo \Illuminate\View\Factory::parentPlaceholder('scripts'); ?>
        <script>
            $(function () {
                // Handle Save Button Click
                $('.datatable-User').on('click', '.save-days-btn', function () {
                    const followUpId = $(this).attr('data-followUp-id');
                    const numberOfHours = $('.days-input[data-followUp-id="' + followUpId + '"]').val();
                    console.log(followUpId,' ',numberOfHours);
                    // Perform Ajax Request
                    $.ajax({
                        url: "<?php echo e(route('extraHours.updateNumberOfHours')); ?>",
                        method: 'POST',
                        data: {
                            follow_up_id: followUpId,
                            number_of_hours: numberOfHours,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            // Handle success response, if needed
                            $('#attended-hours-' + followUpId).text(numberOfHours);
                            $('.save-days-btn[data-followUp-id="' + followUpId + '"]').css('background-color', 'red');

                            console.log(response);
                        },
                        error: function (xhr) {
                            // Handle error response, if needed
                            console.error(xhr);
                        }
                    });
                });
            });
        </script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/extra-hours/index.blade.php ENDPATH**/ ?>