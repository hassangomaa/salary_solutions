<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <div class="d-flex justify-content-center">
        <a href="#" class="brand-link">
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

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        
                        <li class="nav-item has-treeview <?php echo e(request()->is("admin/permissions*") ? "menu-open" : ""); ?> <?php echo e(request()->is("admin/roles*") ? "menu-open" : ""); ?> <?php echo e(request()->is("admin/users*") ? "menu-open" : ""); ?>">
                            <a class="nav-link nav-dropdown-toggle <?php echo e(request()->is("admin/permissions*") ? "active" : ""); ?> <?php echo e(request()->is("admin/roles*") ? "active" : ""); ?> <?php echo e(request()->is("admin/users*") ? "active" : ""); ?>"
                               href="#">
                                <i class="fa-fw nav-icon fas fa-users">

                                </i>
                                <p>
                                    
                                    User Management
                                    <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                
                                
                                
                                

                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                

                                
                                
                                
                                
                                
                                
                                
                                
                                
                                <li class="nav-item">
                                    <a href="<?php echo e(route("users.index")); ?>"
                                       class="nav-link <?php echo e(request()->is("admin/users") || request()->is("admin/users/*") ? "active" : ""); ?>">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            
                                            Users
                                        </p>
                                    </a>
                                </li>
                                
                            </ul>
                        </li>        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
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
            <?php endif; ?>

            
            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            

            
            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            
            
            

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<?php /**PATH /media/hassan/AE24833A24830515/php_Projects/htdocs/projects/salary_solutions/resources/views/partials/menu.blade.php ENDPATH**/ ?>