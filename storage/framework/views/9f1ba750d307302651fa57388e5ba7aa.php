<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu',[$flag], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="card">
        <div class="card-header">
            <?php echo e(trans('global.show')); ?> <?php echo e(trans('cruds.user.title')); ?>

        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="<?php echo e(route('users.index')); ?>">
                        <?php echo e(trans('global.back_to_list')); ?>

                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.id')); ?>

                        </th>
                        <td>
                            <?php echo e($user->id); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.name')); ?>

                        </th>
                        <td>
                            <?php echo e($user->name); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.email')); ?>

                        </th>
                        <td>
                            <?php echo e($user->email); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.email_verified_at')); ?>

                        </th>
                        <td>
                            <?php echo e($user->email_verified_at); ?>

                        </td>
                    </tr>

                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.phone')); ?>

                        </th>
                        <td>
                            <?php echo e($user->phone); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.adress')); ?>

                        </th>
                        <td>
                            <?php echo e($user->address); ?>

                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="<?php echo e(route('users.index')); ?>">
                        <?php echo e(trans('global.back_to_list')); ?>

                    </a>
                </div>
            </div>
        </div>
    </div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/users/show.blade.php ENDPATH**/ ?>