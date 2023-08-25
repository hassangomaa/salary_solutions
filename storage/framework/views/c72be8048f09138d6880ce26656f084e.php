<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu',[$flag], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="<?php echo e(route('borrowing.create')); ?>">
                <?php echo e(__('borrow.add_borrowing')); ?>

            </a>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <?php echo e(__('borrow.borrowing_list')); ?>

        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        <?php echo e(__('borrow.id')); ?>

                    </th>
                    <th>
                        <?php echo e(__('borrow.name')); ?>

                    </th>
                    <th>
                        <?php echo e(__('borrow.position')); ?>

                    </th>
                    <th>
                        <?php echo e(__('borrow.amount')); ?>

                    </th>
                    <th>
                        <?php echo e(__('borrow.month')); ?>

                    </th>
                    <th>
                        <?php echo e(__('borrow.created_at')); ?>

                    </th> <th>
                        <?php echo e(__('borrow.actions')); ?>

                    </th>

                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="<?php echo e(__('borrow.search')); ?>">
                    </td>

                    <td>
                        <input class="search" type="text" placeholder="<?php echo e(__('borrow.search')); ?>">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="<?php echo e(__('borrow.search')); ?>">

                    </td>
                    <td>
                        <input class="search" type="text" placeholder="<?php echo e(__('borrow.search')); ?>">

                    </td>
                    <td>
                        <input class="search" type="text" placeholder="<?php echo e(__('borrow.search')); ?>">

                    </td>
                    <td>
                        <input class="search" type="text" placeholder="<?php echo e(__('borrow.search')); ?>">

                    </td>
                    <td></td>

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
            
            let deleteButtonTrans = '<?php echo e(__('borrow.delete_selected')); ?>';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "<?php echo e(route('borrowing.massDestroy')); ?>",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({selected: true}).data(), function (entry) {
                        return entry.id
                    });

                    if (ids.length === 0) {
                        alert('<?php echo e(__('global.no_rows_selected')); ?>')

                        return
                    }

                    if (confirm('<?php echo e(__('global.are_you_sure')); ?>')) {
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
                ajax: "<?php echo e(route('borrowing.index')); ?>",
                columns: [
                    {data: 'placeholder', name: 'placeholder'},
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'position', name: 'position'},
                    {data: 'amount', name: 'amount'},
                    {data: 'month', name: 'month'},
                    {data: 'created_at', name: 'created_at'},
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/borrowing/index.blade.php ENDPATH**/ ?>