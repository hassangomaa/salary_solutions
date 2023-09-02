<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu', [$flag], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="card">
        <div class="card-header">
            <?php echo e(trans('deductions.deduction_list')); ?>

        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User table-responsive">
                <thead>
                <tr>
                    <th><?php echo e(trans('deductions.id')); ?></th>
                    <th><?php echo e(trans('deductions.name')); ?></th>
                    <th><?php echo e(trans('deductions.position')); ?></th>
                    <th><?php echo e(trans('deductions.housing')); ?></th>
                    <th><?php echo e(trans('deductions.penalty')); ?></th>
                    <th><?php echo e(trans('deductions.absence')); ?></th>
                    <th><?php echo e(trans('deductions.set_deduction')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $deductions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deduction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($deduction->id); ?></td>
                        <td><?php echo e($deduction->employee->name); ?></td>
                        <td><?php echo e($deduction->employee->position); ?></td>
                        <td><input type="number" class="days-input" name="housing" data-housing-id="<?php echo e($deduction->id); ?>" value="<?php echo e($deduction->housing); ?>"></td>
                        <td><input type="number" class="days-input" name="penalty" data-penalty-id="<?php echo e($deduction->id); ?>" value="<?php echo e($deduction->penalty); ?>"></td>
                        <td><input type="number" class="days-input" name="absence" data-absence-id="<?php echo e($deduction->id); ?>" value="<?php echo e($deduction->absence); ?>"></td>
                        <td>
                            <button class="btn btn-primary save-days-btn" data-deduction-id="<?php echo e($deduction->id); ?>"><?php echo e(trans('deductions.set_deduction')); ?></button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php echo e($deductions->links('vendor.pagination.bootstrap-5')); ?>

    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
        <?php echo \Illuminate\View\Factory::parentPlaceholder('scripts'); ?>
        <script>
            $(function () {
                $('.datatable-User').on('click', '.save-days-btn', function () {
                    const deductionId = $(this).attr('data-deduction-id');
                    const housing = $('[name="housing"][data-housing-id="' + deductionId + '"]').val();
                    const penalty = $('[name="penalty"][data-penalty-id="' + deductionId + '"]').val();
                    const absence = $('[name="absence"][data-absence-id="' + deductionId + '"]').val();

                    // Perform Ajax Request
                    $.ajax({
                        url: "<?php echo e(route('deduction.addDeduction')); ?>", // Change this to your actual route
                        method: 'POST',
                        data: {
                            deduction_id: deductionId,
                            housing: housing,
                            penalty: penalty,
                            absence: absence,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            // Handle success response, if needed
                            console.log(response);
                            $('.save-days-btn[data-deduction-id="' + deductionId + '"]').css('background-color', 'red');

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/deduction/index.blade.php ENDPATH**/ ?>