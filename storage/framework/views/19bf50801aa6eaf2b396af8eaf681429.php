<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu', [$flag], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="card">
        <div class="card-header">
            <?php echo e(trans('global.edit')); ?> Borrow
        </div>

        <div class="card-body">
            <form method="POST" action="<?php echo e(route('borrowing.update', $borrow->id)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="form-group">
                    <label class="required" for="employee_id">Employee</label>
                    <input
                        type="text"
                        class="form-control"
                        name="employee_name"
                        id="employee_name"
                        value="<?php echo e($borrow->employee->name); ?>"
                    >
                    <input type="hidden" name="employee_id" id="employee_id" value="<?php echo e($borrow->employee->id); ?>">
                    <div id="employee_suggestions"></div>
                </div>
                <div class="form-group">
                    <label class="required" for="month">Month</label>
                    <input class="form-control <?php echo e($errors->has('month') ? 'is-invalid' : ''); ?>" type="number" name="month" id="month" value="<?php echo e(old('month', $borrow->month)); ?>" required>
                    <?php if($errors->has('month')): ?>
                        <span class="text-danger"><?php echo e($errors->first('month')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="required" for="amount">Amount</label>
                    <input class="form-control <?php echo e($errors->has('amount') ? 'is-invalid' : ''); ?>" type="number" name="amount" id="amount" value="<?php echo e(old('amount', $borrow->amount)); ?>" required>
                    <?php if($errors->has('amount')): ?>
                        <span class="text-danger"><?php echo e($errors->first('amount')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="required" for="statement">Statement</label>
                    <input class="form-control <?php echo e($errors->has('statement') ? 'is-invalid' : ''); ?>" type="text" name="statement" id="statement" value="<?php echo e(old('statement', $borrow->statement)); ?>" required>
                    <?php if($errors->has('statement')): ?>
                        <span class="text-danger"><?php echo e($errors->first('statement')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        <?php echo e(trans('global.update')); ?>

                    </button>
                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php $__env->startSection('scripts'); ?>
        <script>
            $(function() {
                $("#employee_name").on("input", function() {
                    var searchTerm = $(this).val();

                    $.ajax({
                        url: "<?php echo e(route('employee.getAllEmployees')); ?>",
                        method: "GET",
                        data: { term: searchTerm },
                        success: function(response) {
                            var suggestionsHtml = "";
                            $.each(response, function(index, employee) {
                                suggestionsHtml += `<div class="suggestion" data-id="${employee.id}">${employee.name}</div>`;
                            });
                            $("#employee_suggestions").html(suggestionsHtml);
                        }
                    });
                });

                // Handle suggestion click
                $(document).on("click", ".suggestion", function() {
                    var employeeId = $(this).data("id");
                    var employeeName = $(this).text();
                    $("#employee_id").val(employeeId);
                    $("#employee_name").val(employeeName);
                    $("#employee_suggestions").html(""); // Clear suggestions
                });
            });
        </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/borrowing/edit.blade.php ENDPATH**/ ?>