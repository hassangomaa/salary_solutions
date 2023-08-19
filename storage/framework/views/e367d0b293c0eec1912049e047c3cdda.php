<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="card">
        <div class="card-header">
         Deposit Details
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="<?php echo e(route('companyPayments.index')); ?>">
                        <?php echo e(trans('global.back_to_list')); ?>

                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
ID                        </th>
                        <td>
                            <?php echo e($deposit->id); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
Amount                        </th>
                        <td>
                            <?php echo e($deposit->amount); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
Statement                        </th>
                        <td>
                            <?php echo e($deposit->statement); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
Type                        </th>
                        <td>
                            <?php echo e($deposit->type); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
Company Name                        </th>
                        <td>
                            <?php echo e($deposit->company->name ?? ''); ?>

                        </td>
                    </tr>
                    <!-- Add more fields as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/company-payments/show.blade.php ENDPATH**/ ?>