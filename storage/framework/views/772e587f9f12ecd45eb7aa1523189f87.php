<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu',[$flag], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 mb-4">
                <a href="<?php echo e(route('company.clickOnCompany',$company->id)); ?>" class="card-link">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title"><?php echo e($company->name); ?></h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Company Credit: <?php echo e($company->credit); ?></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/hassan/AE24833A24830515/php_Projects/htdocs/projects/salary_solutions/resources/views/company/companyDashboard.blade.php ENDPATH**/ ?>