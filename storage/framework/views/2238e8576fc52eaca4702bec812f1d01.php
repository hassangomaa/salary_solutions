<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu', [$flag], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="card">
        <div class="card-header">
            <?php echo e(trans('reports.reports_list')); ?>

        </div>

        <div class="card-body">
            <div class="col-lg-6">
                <a class="btn btn-success" href="<?php echo e(route('company.clickToGenerateReport')); ?>">
                انشئ التقرير لهذا الشهر
                </a>
            </div>
            <div class="form-group">
                <label for="search"><?php echo e(trans('global.search')); ?></label>
                <input class="form-control" type="text" id="search" name="search" placeholder="<?php echo e(trans('global.search_placeholder')); ?>">
            </div>

            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
                <thead>
                <tr>
                    <th><?php echo e(trans('reports.id')); ?></th>
                    <th><?php echo e(trans('reports.file_name')); ?></th>
                    <th><?php echo e(trans('reports.month')); ?></th>
                    <th><?php echo e(trans('reports.year')); ?></th>
                    <th><?php echo e(trans('reports.download')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($file->id); ?></td>
                        <td><?php echo e($file->file_name); ?></td>
                        <td><?php echo e($file->month); ?></td>
                        <td><?php echo e($file->year); ?></td>
                        <td>
                            <a href="<?php echo e(route('excel.downloadFile',$file->id)); ?>" class="btn btn-primary">
                                <?php echo e(trans('reports.download')); ?> Excel
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php echo e($files->links('vendor.pagination.bootstrap-5')); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/reports/index.blade.php ENDPATH**/ ?>