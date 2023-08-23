<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu', [$flag], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="card">
        <div class="card-header">
            <?php echo e(trans('global.show')); ?> Borrow
        </div>

        <div class="card-body">
            <table class="table">
                <tbody>
                <tr>
                    <th>Employee Name</th>
                    <td><?php echo e($borrow->employee->name); ?></td>
                </tr>
                <tr>
                    <th><?php echo e(trans('global.month')); ?></th>
                    <td><?php echo e($borrow->month); ?></td>
                </tr>
                <tr>
                    <th><?php echo e(trans('global.amount')); ?></th>
                    <td><?php echo e($borrow->amount); ?></td>
                </tr>
                <tr>
                    <th>Statement</th>
                    <td><?php echo e($borrow->statement); ?></td>
                </tr>
                <!-- Add more fields here -->
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/borrowing/show.blade.php ENDPATH**/ ?>