
    <a class="btn btn-xs btn-primary" href="<?php echo e(route($crudRoutePart . '.show', $row->id)); ?>">
        <?php echo e(trans('global.view')); ?>

    </a>


    <a class="btn btn-xs btn-info" href="<?php echo e(route($crudRoutePart . '.edit', $row->id)); ?>">
        <?php echo e(trans('global.edit')); ?>

    </a>


    <form action="<?php echo e(route($crudRoutePart . '.destroy', $row->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(trans('global.areYouSure')); ?>');" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
        <input type="submit" class="btn btn-xs btn-danger" value="<?php echo e(trans('global.delete')); ?>">
    </form>

<?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/partials/datatablesActions.blade.php ENDPATH**/ ?>