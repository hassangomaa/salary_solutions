<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu',[$flag], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="<?php echo e(route('employee.create')); ?>">
                <?php echo e(trans('employee.add_new')); ?>

            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <?php echo e(trans('employee.title')); ?>

        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
                <thead>
                <tr>
                    <th width="10"></th>
                    <th>ID</th>
                    <th><?php echo e(trans('employee.name')); ?></th>
                    <th><?php echo e(trans('employee.position')); ?></th>
                    <th><?php echo e(trans('employee.daily_fare')); ?></th>
                    <th><?php echo e(trans('employee.overtime_hour_fare')); ?></th>
                    <th><?php echo e(trans('employee.phone')); ?></th>
                    <th><?php echo e(trans('employee.address')); ?></th>
                    <th><?php echo e(trans('global.actions')); ?></th>
                </tr>
                <tr>
                    <td></td>
                    <td><input class="search" type="text" placeholder="<?php echo e(trans('global.search')); ?>"></td>
                    <td><input class="search" type="text" placeholder="<?php echo e(trans('global.search')); ?>"></td>
                    <td><input class="search" type="text" placeholder="<?php echo e(trans('global.search')); ?>"></td>
                    <td><input class="search" type="text" placeholder="<?php echo e(trans('global.search')); ?>"></td>
                    <td><input class="search" type="text" placeholder="<?php echo e(trans('global.search')); ?>"></td>
                    <td><input class="search" type="text" placeholder="<?php echo e(trans('global.search')); ?>"></td>
                    <td><input class="search" type="text" placeholder="<?php echo e(trans('global.search')); ?>"></td>
                    <td>&nbsp;</td>
                </tr>
                </thead>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            
            let deleteButtonTrans = 'Delete Selected';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "<?php echo e(route('employee.massDestroy')); ?>",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({selected: true}).data(), function (entry) {
                        return entry.id
                    });

                    if (ids.length === 0) {
                        alert(' No Rows Selected ')

                        return
                    }

                    if (confirm('<?php echo e(trans('global.areYouSure')); ?>')) {
                        $.ajax({
                            headers: {'x-csrf-token': /*_token*/ $('meta[name="csrf-token"]').attr('content')},
                            method: 'POST',
                            url: config.url,
                            data: {ids: ids, _method: 'DELETE'}
                        })
                            .done(function () {
                                location.reload()
                            })
                    }
                }
            }
            dtButtons.push(deleteButton)
            

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "<?php echo e(route('employee.index')); ?>",
                columns: [
                    {data: 'placeholder', name: 'placeholder'},
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'position', name: 'position'},
                    {data: 'daily_fare', name: 'daily_fare'},
                    {data: 'overtime_hour_fare', name: 'overtime_hour_fare'},
                    {data: 'phone', name: 'phone'},
                    {data: 'address', name: 'address'},
                    {data: 'actions', name: 'actions'}
                ],
                orderCellsTop: true,
                order: [[1, 'desc']],
                pageLength: 100,
            };
            let table = $('.datatable-User').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

            let visibleColumnsIndexes = null;
            $('.datatable thead').on('input', '.search', function () {
                let strict = $(this).attr('strict') || false
                let value = strict && this.value ? "^" + this.value + "$" : this.value

                let index = $(this).parent().index()
                if (visibleColumnsIndexes !== null) {
                    index = visibleColumnsIndexes[index]
                }

                table
                    .column(index)
                    .search(value, strict)
                    .draw()
            });
            table.on('column-visibility.dt', function (e, settings, column, state) {
                visibleColumnsIndexes = []
                table.columns(":visible").every(function (colIdx) {
                    visibleColumnsIndexes.push(colIdx);
                });
            })
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/employees/index.blade.php ENDPATH**/ ?>