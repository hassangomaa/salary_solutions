<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu',[$flag], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="card">
        <div class="card-header">
            Show Employee
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="<?php echo e(route('employee.index')); ?>">
                        <?php echo e(trans('global.back_to_list')); ?>

                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            ID
                        </th>
                        <td>
                            <?php echo e($employee->id); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            Name
                        </th>
                        <td>
                            <?php echo e($employee->name); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            Position
                        </th>
                        <td>
                            <?php echo e($employee->position); ?>

                        </td>
                    </tr>

                    <tr>
                        <th>
                            Daily Fare
                        </th>
                        <td>
                            <?php echo e($employee->daily_fare); ?>

                        </td>
                    </tr>











                    <tr>
                        <th>
                            Phone
                        </th>
                        <td>
                            <?php echo e($employee->phone); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            Address
                        </th>
                        <td>
                            <?php echo e($employee->address); ?>

                        </td>
                    </tr>
                    </tbody>
                </table>
                
                
                
                
                
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <?php echo e(trans('global.relatedData')); ?>

        </div>
        <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#commissions" role="tab" data-toggle="tab">
                    Commissions
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#deductions" role="tab" data-toggle="tab">
                    Deductions
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" role="tabpanel" id="commissions">
                <?php if ($__env->exists('commission.index', ['commissions' => $employee->commissions,'employeeId'=>$employee->id])) echo $__env->make('commission.index', ['commissions' => $employee->commissions,'employeeId'=>$employee->id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="tab-pane" role="tabpanel" id="deductions">
                <?php if ($__env->exists('deduction.index', ['deductions' => $employee->deductions,'employeeId'=>$employee->id])) echo $__env->make('deduction.index', ['deductions' => $employee->deductions,'employeeId'=>$employee->id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#relationship-tabs a").click(function(e) {
                e.preventDefault();
                $(this).tab("show");
            });
        });
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/employees/show.blade.php ENDPATH**/ ?>