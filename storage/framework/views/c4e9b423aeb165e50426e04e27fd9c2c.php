<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="<?php echo e(route('company.create')); ?>">
                <?php echo e(trans('company-management.add_company')); ?>

            </a>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <?php echo e(trans('company-management.company_list')); ?>

        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
                <thead>
                <tr>
                    <th width="10"></th>
                    <th><?php echo e(trans('company-management.id')); ?></th>
                    <th><?php echo e(trans('company-management.company_name')); ?></th>
                    <th><?php echo e(trans('company-management.credit')); ?></th>
                    <th><?php echo e(trans('company-management.phone')); ?></th>
                    <th><?php echo e(trans('company-management.address')); ?></th>
                    <th><?php echo e(trans('company-management.actions')); ?></th>
                </tr>
                <tr>
                    <td></td>
                    <td><input class="search" type="text" placeholder="<?php echo e(trans('company-management.search')); ?>"></td>
                    <td><input class="search" type="text" placeholder="<?php echo e(trans('company-management.search')); ?>"></td>
                    <td><input class="search" type="text" placeholder="<?php echo e(trans('company-management.search')); ?>"></td>
                    <td><input class="search" type="text" placeholder="<?php echo e(trans('company-management.search')); ?>"></td>
                    <td><input class="search" type="text" placeholder="<?php echo e(trans('company-management.search')); ?>"></td>
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
            
            let deleteButtonTrans = '<?php echo e(trans('company-management.delete_selected')); ?>';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "<?php echo e(route('company.massDestroy')); ?>",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({selected: true}).data(), function (entry) {
                        return entry.id
                    });

                    if (ids.length === 0) {
                        alert('<?php echo e(trans('company-management.no_rows_selected')); ?>');
                        return;
                    }

                    if (confirm('<?php echo e(trans('global.areYouSure')); ?>')) {
                        $.ajax({
                            headers: {'x-csrf-token': $('meta[name="csrf-token"]').attr('content')},
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
                ajax: "<?php echo e(route('company.index')); ?>",
                columns: [
                    {data: 'placeholder', name: 'placeholder'},
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'credit', name: 'credit'},
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/company/index.blade.php ENDPATH**/ ?>