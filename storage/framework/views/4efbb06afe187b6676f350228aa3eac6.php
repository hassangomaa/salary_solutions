<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu',[$flag], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>










    <div class="card">
        <div class="card-header">
           Incentives List
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User table-responsive">
                <thead>
                <!-- Table Header Columns -->
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>incentive</th>
                    <th>bonus</th>
                    <th>regularity</th>
                    <th>gift</th>
                    <th>Set Incentives</th>
                </tr>
                </thead>
                <tbody>
                <!-- Loop through companies -->
                <?php $__currentLoopData = $incentives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $incentive): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($incentive->id); ?></td>
                        <td><?php echo e($incentive->employee->name); ?></td>
                        <td><?php echo e($incentive->employee->position); ?></td>
                        <td>  <input type="number" class="days-input" name="incentive" data-incentive-id="<?php echo e($incentive->id); ?>" value="<?php echo e($incentive->incentive); ?>"></td>
                        <td> <input type="number" class="days-input" name="bonus" data-bonus-id="<?php echo e($incentive->id); ?>" value="<?php echo e($incentive->bonus); ?>"></td>
                        <td><input type="number" class="days-input" name="regularity" data-regularity-id="<?php echo e($incentive->id); ?>" value="<?php echo e($incentive->regularity); ?>"></td>
                        <td><input type="number" class="days-input" name="gift" data-gift-id="<?php echo e($incentive->id); ?>" value="<?php echo e($incentive->gift); ?>"></td>

                        <td>
                            <button class="btn btn-primary save-days-btn" data-incentive-id="<?php echo e($incentive->id); ?>">Save</button>
                        </td>


                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php echo e($incentives->links('vendor.pagination.bootstrap-5')); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
        <?php echo \Illuminate\View\Factory::parentPlaceholder('scripts'); ?>
        <script>
            $(function () {
                $('.datatable-User').on('click', '.save-days-btn', function () {
                    const incentiveId = $(this).attr('data-incentive-id');
                    const incentive = $('[name="incentive"][data-incentive-id="' + incentiveId + '"]').val();
                    const bonus = $('[name="bonus"][data-bonus-id="' + incentiveId + '"]').val();
                    const regularity = $('[name="regularity"][data-regularity-id="' + incentiveId + '"]').val();
                    const gift = $('[name="gift"][data-gift-id="' + incentiveId + '"]').val();

                    // Perform Ajax Request
                    $.ajax({
                        url: "<?php echo e(route('incentive.addIncentives')); ?>", // Change this to your actual route
                        method: 'POST',
                        data: {
                            incentive_id: incentiveId,
                            incentive: incentive,
                            bonus: bonus,
                            regularity: regularity,
                            gift: gift,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            // Handle success response, if needed
                            console.log(response);
                            $('.save-days-btn[data-incentive-id="' + incentiveId + '"]').css('background-color', 'red');

                        },
                        error: function (xhr) {
                            // Handle error response, if needed
                            console.error(xhr);
                        }
                    });
                });
            });
        </script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/incentive/index.blade.php ENDPATH**/ ?>