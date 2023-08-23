<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu',[$flag], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <div class="card">
        <div class="card-header">
            Borrowing List
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
                <thead>
                <!-- Table Header Columns -->
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Week 1</th>
                    <th>Week 2</th>
                    <th>Week 3</th>
                    <th>Week 4</th>
                    <th>Actions</th>
                    
                </tr>
                </thead>
                <tbody>
                <!-- Loop through companies -->
                <?php $__currentLoopData = $followUps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $followUp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>

                        <td><?php echo e($followUp->employee->name); ?></td>
                        <td><?php echo e($followUp->employee->position); ?></td>
                        <td><input type="number" class="week-input" id="week1_<?php echo e($followUp->id); ?>" data-week="1" value="<?php echo e($followUp->borrow_week_one); ?>"></td>
                        <td><input type="number" class="week-input" id="week2_<?php echo e($followUp->id); ?>" data-week="2" value="<?php echo e($followUp->borrow_week_two); ?>"></td>
                        <td><input type="number" class="week-input" id="week3_<?php echo e($followUp->id); ?>" data-week="3" value="<?php echo e($followUp->borrow_week_three); ?>"></td>
                        <td><input type="number" class="week-input" id="week4_<?php echo e($followUp->id); ?>" data-week="4" value="<?php echo e($followUp->borrow_week_four); ?>"></td>
                        <td>
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
                // const followUpId = $(this).data('followUp-id');
            // const followUpId = $(this).attr('.followUp').val()

                const followUpId = $(this).attr('data-followUp-id');

                const weeksData = {};

                // console.log('follow up '+followUpId )

                const week1Value = $('#week1_' + followUpId).val();
                const week2Value = $('#week2_' + followUpId).val();
                const week3Value = $('#week3_' + followUpId).val();
                const week4Value = $('#week4_' + followUpId).val();


                console.log('Week 1:', week1Value);
                console.log('Week 2:', week2Value);
                console.log('Week 3:', week3Value);
                console.log('Week 4:', week4Value);
                // Perform Ajax Request
                $.ajax({
                    url: "<?php echo e(route('borrowing.store')); ?>",
                    method: 'POST',
                    data: {
                        follow_up_id: followUpId,
                        week1: week1Value,
                        week2: week2Value,
                        week3: week3Value,
                        week4: week4Value,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        // Handle success response, if needed
                        alert('Data saved successfully.');

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/borrowing/index.blade.php ENDPATH**/ ?>