<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu',[$flag], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="card">
    <div class="card-header">
       Edit user
    </div>

    <div class="card-body">
        <form method="POST" action="<?php echo e(route('users.update', ['userId' => $user->id ] )); ?>" >
            <?php echo method_field('PUT'); ?>
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label class="required" for="name">Name</label>
                <input class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>" type="text" name="name" id="name" value="<?php echo e(old('name', $user->name)); ?>" required>
                <?php if($errors->has('name')): ?>
                    <span class="text-danger"><?php echo e($errors->first('name')); ?></span>
                <?php endif; ?>

            <div class="form-group">
                <label class="required" for="email">Email</label>
                <input class="form-control <?php echo e($errors->has('email') ? 'is-invalid' : ''); ?>" type="text" name="email" id="email" value="<?php echo e(old('email', $user->email)); ?>" required>
                <?php if($errors->has('email')): ?>
                    <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
                <?php endif; ?>
            </div>

                <div class="form-group">
                    <label class="required" for="password">Password</label>
                    <input class="form-control <?php echo e($errors->has('password') ? 'is-invalid' : ''); ?>" type="text" name="password"
                           id="password" placeholder="password" >
                    <?php if($errors->has('password')): ?>
                        <span class="text-danger"><?php echo e($errors->first('password')); ?></span>
                    <?php endif; ?>
                </div>


            <div class="form-group">
                <label for="phone">Phone</label>
                <input class="form-control <?php echo e($errors->has('phone') ? 'is-invalid' : ''); ?>" type="text" name="phone" id="phone" value="<?php echo e(old('phone', $user->phone)); ?>">
                <?php if($errors->has('phone')): ?>
                    <span class="text-danger"><?php echo e($errors->first('phone')); ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control <?php echo e($errors->has('address') ? 'is-invalid' : ''); ?>" name="address" id="address"><?php echo e(old('address', $user->address)); ?></textarea>
                <?php if($errors->has('address')): ?>
                    <span class="text-danger"><?php echo e($errors->first('address')); ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                  Save
                </button>
            </div>
        </form>
    </div>
</div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/users/edit.blade.php ENDPATH**/ ?>