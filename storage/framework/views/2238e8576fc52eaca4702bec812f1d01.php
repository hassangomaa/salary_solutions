<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu',[$flag], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>










    <div class="card">
        <div class="card-header">
            Reports List
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
                <thead>
                <!-- Table Header Columns -->
                <tr>
                    <th>ID</th>
                    <th>File Name</th>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Download</th>
                </tr>
                </thead>
                <tbody>
                <!-- Loop through companies -->
                <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($file->id); ?></td>
                        <td><?php echo e($file->file_name); ?></td>
                        <td><?php echo e($file->month); ?></td>
                        <td><?php echo e($file->year); ?></td>
                        <td>
                            <a href="<?php echo e(route('excel.downloadFile',$file->id)); ?>" class="btn btn-primary">
                                Download Excel
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