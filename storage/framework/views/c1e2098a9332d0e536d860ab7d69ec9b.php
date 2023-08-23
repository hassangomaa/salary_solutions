<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <div class="d-flex justify-content-center">
        <a href="/admin" class="brand-link">
            <span class="brand-text font-weight-light"><?php echo e(trans('panel.site_title')); ?></span>
        </a>
    </div>


    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php if($flag == 0): ?>

                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs("company.companyDashboard") ? "active" : ""); ?>"
                           href="<?php echo e(route("company.companyDashboard")); ?>">
                            <i class="fas fa-fw fa-tachometer-alt nav-icon">
                            </i>
                            <p>
                                <?php echo e(trans('global.dashboard')); ?>

                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs("company.indexBlade") ? "active" : ""); ?>"
                           href="<?php echo e(route("company.indexBlade")); ?>">
                            <i class="fas fa-fw fa-tachometer-alt nav-icon">
                            </i>
                            <p>
                                Companies Management
                            </p>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs("employee.index") ? "active" : ""); ?>"
                           href="<?php echo e(route("employee.index")); ?>">
                            <i class="fas fa-fw fa-tachometer-alt nav-icon">
                            </i>
                            <p>
                                Show Employees
                            </p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs("attendance.index") ? "active" : ""); ?>"
                           href="<?php echo e(route("attendance.index")); ?>">
                            <i class="fas fa-fw fa-tachometer-alt nav-icon">
                            </i>
                            <p>
                                Attendance
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs("borrowing.index") ? "active" : ""); ?>"
                           href="<?php echo e(route("borrowing.index")); ?>">
                            <i class="fas fa-fw fa-tachometer-alt nav-icon">
                            </i>
                            <p>
                                Borrowing
                            </p>
                        </a>
                    </li>

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

























































                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        

                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs("companyPayments.index") ? "active" : ""); ?>"
                               href="<?php echo e(route("companyPayments.index")); ?>">
                                <i class="fas fa-fw fa-tachometer-alt nav-icon">
                                </i>
                                <p>
                                    Payments
                                </p>
                            </a>
                        </li>
                            <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs("company.index") ? "active" : ""); ?>"
                               href="<?php echo e(route("company.index")); ?>">
                                <i class="fas fa-fw fa-tachometer-alt nav-icon">
                                </i>
                                <p>
                                    Back To Companies
                                </p>
                            </a>
                        </li>


                    </ul>
            <?php endif; ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link"
                               onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                <p>
                                    <i class="fas fa-fw fa-sign-out-alt nav-icon">

                                    </i>
                                <p><?php echo e(trans('global.logout')); ?></p>
                            </a>
                        </li>
</ul>
</ul>
            
            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            

            
            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            
            
            

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/partials/menu.blade.php ENDPATH**/ ?>