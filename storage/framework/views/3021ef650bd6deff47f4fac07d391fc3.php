<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu',[$flag], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="card">
        <div class="card-header">
            <?php echo e(trans('global.edit')); ?> <?php echo e(trans('cruds.company.title_singular')); ?>

        </div>

        <div class="card-body">
            <form method="POST" action="<?php echo e(route("company.update", $company->id)); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="form-group">
                    <label class="required" for="name">Company Name</label>
                    <input class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>" type="text" name="name" id="name" value="<?php echo e(old('name', $company->name)); ?>" required>
                    <?php if($errors->has('name')): ?>
                        <span class="text-danger"><?php echo e($errors->first('name')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="required" for="address">Company Address</label>
                    <input class="form-control <?php echo e($errors->has('address') ? 'is-invalid' : ''); ?>" type="text" name="address" id="address" value="<?php echo e(old('address', $company->address)); ?>" required>
                    <?php if($errors->has('address')): ?>
                        <span class="text-danger"><?php echo e($errors->first('address')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="required" for="phone">Company Phone</label>
                    <input class="form-control <?php echo e($errors->has('phone') ? 'is-invalid' : ''); ?>" type="text" name="phone" id="phone" value="<?php echo e(old('phone', $company->phone)); ?>" required>
                    <?php if($errors->has('phone')): ?>
                        <span class="text-danger"><?php echo e($errors->first('phone')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="required" for="credit">Company Credit</label>
                    <input class="form-control <?php echo e($errors->has('credit') ? 'is-invalid' : ''); ?>" type="number" name="credit" id="credit" value="<?php echo e(old('credit', $company->credit)); ?>" required>
                    <?php if($errors->has('credit')): ?>
                        <span class="text-danger"><?php echo e($errors->first('credit')); ?></span>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/hassan/AE24833A24830515/php_Projects/htdocs/projects/salary_solutions/resources/views/company/edit.blade.php ENDPATH**/ ?>