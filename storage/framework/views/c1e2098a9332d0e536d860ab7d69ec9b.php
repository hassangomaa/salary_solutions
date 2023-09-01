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
                                <?php echo e(trans('sidebar.companies_management')); ?>

                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route("users.index")); ?>"
                           class="nav-link <?php echo e(request()->is("admin/users") || request()->is("admin/users/*") ? "active" : ""); ?>">
                            <i class="fa-fw nav-icon fas fa-user">

                            </i>
                            <p>
                                <?php echo e(trans('sidebar.users')); ?>

                            </p>
                        </a>
                    </li>
                    <?php if( Config::get('app.locale') == 'ar'): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs("company.index") ? "active" : ""); ?>"
                               href="<?php echo e(route("setLanguage",2)); ?>">
                                <i class="fas fa-fw fa-tachometer-alt nav-icon">
                                </i>
                                <p>
                                    تغيير للغة الانجليزية
                                </p>
                            </a>
                        </li>
                    <?php elseif(Config::get('app.locale') == 'en'): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->routeIs("company.index") ? "active" : ""); ?>"
                               href="<?php echo e(route("setLanguage",1)); ?>">
                                <i class="fas fa-fw fa-tachometer-alt nav-icon">
                                </i>
                                <p>
                                    Change To Arabic Language
                                </p>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs("employee.index") ? "active" : ""); ?>"
                           href="<?php echo e(route("employee.index")); ?>">
                            <i class="fas fa-fw fa-tachometer-alt nav-icon">
                            </i>
                            <p>
                                <?php echo e(trans('sidebar.show_employees')); ?>

                            </p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs("attendance.index") ? "active" : ""); ?>"
                           href="<?php echo e(route("attendance.index")); ?>">
                            <i class="fas fa-fw fa-tachometer-alt nav-icon">
                            </i>
                            <p>
                                <?php echo e(trans('sidebar.attendance')); ?>

                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs("extraHours.index") ? "active" : ""); ?>"
                           href="<?php echo e(route("extraHours.index")); ?>">
                            <i class="fas fa-fw fa-tachometer-alt nav-icon">
                            </i>
                            <p>
                                <?php echo e(trans('sidebar.extraHours')); ?>

                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs("incentive.index") ? "active" : ""); ?>"
                           href="<?php echo e(route("incentive.index")); ?>">
                            <i class="fas fa-fw fa-tachometer-alt nav-icon">
                            </i>
                            <p>
                                <?php echo e(trans('sidebar.incentive')); ?>

                            </p>
                        </a>
                    </li>         <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs("deduction.index") ? "active" : ""); ?>"
                           href="<?php echo e(route("deduction.index")); ?>">
                            <i class="fas fa-fw fa-tachometer-alt nav-icon">
                            </i>
                            <p>
                                <?php echo e(trans('sidebar.deduction')); ?>

                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs("borrowing.index") ? "active" : ""); ?>"
                           href="<?php echo e(route("borrowing.index")); ?>">
                            <i class="fas fa-fw fa-tachometer-alt nav-icon">
                            </i>
                            <p>
                                <?php echo e(trans('sidebar.borrowing')); ?>

                            </p>
                        </a>
                    </li>






























                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">


                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->routeIs("companyPayments.index") ? "active" : ""); ?>"
                                   href="<?php echo e(route("companyPayments.index")); ?>">
                                    <i class="fas fa-fw fa-tachometer-alt nav-icon">
                                    </i>
                                    <p>
                                        <?php echo e(trans('sidebar.payments')); ?>

                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->routeIs("excel.index") ? "active" : ""); ?>"
                                   href="<?php echo e(route("excel.index")); ?>">
                                    <i class="fas fa-fw fa-tachometer-alt nav-icon">
                                    </i>
                                    <p>
                                        <?php echo e(trans('sidebar.reports')); ?>

                                    </p>
                                </a>
                            </li>


                        </ul>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs("home") ? "active" : ""); ?>"
                           href="<?php echo e(route("home")); ?>">
                            <i class="fas fa-fw fa-tachometer-alt nav-icon">
                            </i>
                            <p>
                                <?php echo e(trans('sidebar.backToCompanies')); ?>


                            </p>
                        </a>
                    </li>
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
    </div>
</aside>
<?php /**PATH D:\Laragon_Projects\salary_solutions\resources\views/partials/menu.blade.php ENDPATH**/ ?>