<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu',[$flag], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div style="margin-bottom: 10px;" class="row">
        <!-- Add Company Button -->
        <div class="col-lg-12">
            <a class="btn btn-success" href="<?php echo e(route('company.create')); ?>">
                Add Company
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Company List
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
                <thead>
                <!-- Table Header Columns -->
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Number of Days</th>
                    <th>Set Worked Days</th>

                </tr>
                </thead>
                <tbody>
                <!-- Loop through companies -->
                <?php $__currentLoopData = $followUps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $followUp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($followUp->id); ?></td>
                        <td><?php echo e($followUp->employee->name); ?></td>
                        <td><?php echo e($followUp->employee->position); ?></td>
                        <td  id="attended-days-<?php echo e($followUp->id); ?>"><?php echo e($followUp->attended_days); ?></td>
                        <td>
                            <input type="number" class="days-input" name="numberOfDays" data-followUp-id="<?php echo e($followUp->id); ?>" placeholder="Enter days">
                            <button class="btn btn-primary save-days-btn" data-followUp-id="<?php echo e($followUp->id); ?>">Save</button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
        <?php echo \Illuminate\View\Factory::parentPlaceholder('scripts'); ?>
        <script>
            $(function () {
                // Handle Save Button Click
                $('.datatable-User').on('click', '.save-days-btn', function () {
                    const followUpId = $(this).attr('data-followUp-id');
                    const numberOfDays = $('.days-input[data-followUp-id="' + followUpId + '"]').val();
                    console.log(followUpId,' ',numberOfDays);
                    // Perform Ajax Request
                    $.ajax({
                        url: "<?php echo e(route('attendance.updateNumberOfDays')); ?>",
                        method: 'POST',
                        data: {
                            follow_up_id: followUpId,
                            number_of_days: numberOfDays,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            // Handle success response, if needed
                            $('#attended-days-' + followUpId).text(numberOfDays);

                            console.log(response);
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/attendance/index.blade.php ENDPATH**/ ?>