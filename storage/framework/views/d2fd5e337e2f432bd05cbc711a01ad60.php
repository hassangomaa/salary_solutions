<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu', [$flag], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="card">
        <div class="card-header">
            <?php echo e(trans('company-management.show_company_details')); ?>

        </div>

        <div class="card-body">
            <div class="form-group">
                <a class="btn btn-default" href="<?php echo e(route('company.indexBlade')); ?>">
                    <?php echo e(trans('company-management.back_to_list')); ?>

                </a>
            </div>
            <div class="form-group">
                <label for="name"><?php echo e(trans('company-management.company_name')); ?></label>
                <input class="form-control" type="text" name="name" id="name" value="<?php echo e($company->name); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="address"><?php echo e(trans('company-management.company_address')); ?></label>
                <input class="form-control" type="text" name="address" id="address" value="<?php echo e($company->address); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="phone"><?php echo e(trans('company-management.company_phone')); ?></label>
                <input class="form-control" type="text" name="phone" id="phone" value="<?php echo e($company->phone); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="credit"><?php echo e(trans('company-management.company_credit')); ?></label>
                <input class="form-control" type="number" name="credit" id="credit" value="<?php echo e($company->credit); ?>" readonly>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/company/show.blade.php ENDPATH**/ ?>