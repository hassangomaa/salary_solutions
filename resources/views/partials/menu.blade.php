<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <div class="d-flex justify-content-center">
        <a href="/" class="brand-link">
            <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
        </a>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if($flag == 0)

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs("company.companyDashboard") ? "active" : "" }}"
                           href="{{ route("company.companyDashboard") }}">
                            <i class="fas fa-fw fa-tachometer-alt nav-icon">
                            </i>
                            <p>
                                {{ trans('global.dashboard') }}
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs("company.indexBlade") ? "active" : "" }}"
                           href="{{ route("company.indexBlade") }}">
                            <i class="fas fa-fw fa-tachometer-alt nav-icon">
                            </i>
                            <p>
                                اداره الفروع
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("users.index") }}"
                           class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-user">

                            </i>
                            <p>
                                {{ trans('sidebar.users') }}
                            </p>
                        </a>
                    </li>
                    {{-- @if( Config::get('app.locale') == 'ar')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs("company.index") ? "active" : "" }}"
                               href="{{ route("setLanguage",2) }}">
                                <i class="fas fa-fw fa-tachometer-alt nav-icon">
                                </i>
                                <p>
                                    تغيير للغة الانجليزية
                                </p>
                            </a>
                        </li>
                    @elseif(Config::get('app.locale') == 'en')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs("company.index") ? "active" : "" }}"
                               href="{{ route("updateLanguage") }}">
                                <i class="fas fa-fw fa-tachometer-alt nav-icon">
                                </i>
                                <p>
                                    Change To Arabic Language
                                </p>
                            </a>
                        </li>
                    @endif --}}
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs("employee.index") ? "active" : "" }}"
                           href="{{ route("employee.index") }}">
                            <i class="fas fa-fw fa-tachometer-alt nav-icon">
                            </i>
                            <p>
                                {{ trans('sidebar.show_employees') }}
                            </p>
                        </a>
                    </li>






                                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                            data-accordion="false">

                                            <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }}">
                                                <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/permissions*") ? "active" : "" }} {{ request()->is("admin/roles*") ? "active" : "" }} {{ request()->is("admin/users*") ? "active" : "" }}"
                                                   href="#">
                                                    <i class="fa-fw nav-icon fas fa-users">

                                                    </i>
                                                    <p>
                                                        {{ trans('sidebar.attendance') }}
                                                        <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                                                    </p>
                                                </a>
                                                <ul class="nav nav-treeview">

                                                    <li class="nav-item">
                                                        <a class="nav-link {{ request()->routeIs("attendance.index") ? "active" : "" }}"
                                                           href="{{ route("attendance.index") }}">
                                                            <i class="fas fa-fw fa-tachometer-alt nav-icon">
                                                            </i>
                                                            <p>
                                                                {{ trans('sidebar.attendance_all') }}
                                                            </p>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link {{ request()->routeIs("Reports.attendance") ? "active" : "" }}"
                                                           href="{{ route("Reports.attendance") }}">
                                                            <i class="fas fa-fw fa-tachometer-alt nav-icon">
                                                            </i>
                                                            <p>
                                                                {{ trans('sidebar.attendance_day') }}
                                                            </p>
                                                        </a>
                                                    </li>


                                                </ul>
                                            </li>







                    {{-- <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs("extraHours.index") ? "active" : "" }}"
                           href="{{ route("extraHours.index") }}">
                            <i class="fas fa-fw fa-tachometer-alt nav-icon">
                            </i>
                            <p>
                                {{ trans('sidebar.extraHours') }}
                            </p>
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs("incentive.index") ? "active" : "" }}"
                           href="{{ route("incentive.index") }}">
                            <i class="fas fa-fw fa-tachometer-alt nav-icon">
                            </i>
                            <p>
                                {{ trans('sidebar.incentive') }}
                            </p>
                        </a>
                    </li>         <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs("deduction.index") ? "active" : "" }}"
                           href="{{ route("deduction.index") }}">
                            <i class="fas fa-fw fa-tachometer-alt nav-icon">
                            </i>
                            <p>
                                {{ trans('sidebar.deduction') }}
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs("borrowing.index") ? "active" : "" }}"
                           href="{{ route("borrowing.index") }}">
                            <i class="fas fa-fw fa-tachometer-alt nav-icon">
                            </i>
                            <p>
                                {{ trans('sidebar.borrowing') }}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs("safes.index") ? "active" : "" }}"
                           href="{{ route("safes.index") }}">
                            <i class="fas fa-fw fa-tachometer-alt nav-icon">
                            </i>
                            <p>
                                {{ trans('sidebar.safes') }}
                            </p>
                        </a>
                    </li>
{{--                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"--}}
{{--                        data-accordion="false">--}}

{{--                        <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }}">--}}
{{--                            <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/permissions*") ? "active" : "" }} {{ request()->is("admin/roles*") ? "active" : "" }} {{ request()->is("admin/users*") ? "active" : "" }}"--}}
{{--                               href="#">--}}
{{--                                <i class="fa-fw nav-icon fas fa-users">--}}

{{--                                </i>--}}
{{--                                <p>--}}
{{--                                    {{ trans('sidebar.user_management') }}--}}
{{--                                    <i class="right fa fa-fw fa-angle-left nav-icon"></i>--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--                            <ul class="nav nav-treeview">--}}

{{--                                <li class="nav-item">--}}
{{--                                    <a href="{{ route("users.index") }}"--}}
{{--                                       class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">--}}
{{--                                        <i class="fa-fw nav-icon fas fa-user">--}}

{{--                                        </i>--}}
{{--                                        <p>--}}
{{--                                            {{ trans('sidebar.users') }}--}}
{{--                                        </p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">


                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs("companyPayments.index") ? "active" : "" }}"
                                   href="{{ route("companyPayments.index") }}">
                                    <i class="fas fa-fw fa-tachometer-alt nav-icon">
                                    </i>
                                    <p>
                                        {{ trans('sidebar.payments') }}
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs("Reports.index") ? "active" : "" }}"
                                   href="{{ route("Reports.index") }}">
                                    <i class="fas fa-fw fa-tachometer-alt nav-icon">
                                    </i>
                                    <p>
                                        {{ trans('sidebar.reports') }}
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs("transactionLog.index") ? "active" : "" }}"
                                   href="{{ route("transactionLog.index") }}">
                                    <i class="fas fa-fw fa-tachometer-alt nav-icon">
                                    </i>
                                    <p>
                                        {{ trans('transaction-log.logs') }}
                                    </p>
                                </a>
                            </li>


                        </ul>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs("home") ? "active" : "" }}"
                           href="{{ route("home") }}">
                            <i class="fas fa-fw fa-tachometer-alt nav-icon">
                            </i>
                            <p>
                                {{ trans('sidebar.backToCompanies') }}

                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link "
                           href="{{ route("revert") }}" onclick="confirmRevert()">
                            <i class="fas fa-fw fa-tachometer-alt nav-icon">
                            </i>
                            <p>
                                ترحيل
                            </p>
                        </a>
                    </li>
                        @endif
                        <li class="nav-item">
                            <a href="#" class="nav-link"
                               onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                <p>
                                    <i class="fas fa-fw fa-sign-out-alt nav-icon">

                                    </i>
                                <p>{{ trans('global.logout') }}</p>
                            </a>
                        </li>
                    </ul>
            </ul>
        </nav>
    </div>
</aside>

<script>
    function confirmRevert() {
        var confirmation = confirm('هل انت متاكد انك تريد ترحيل جميع بيانات الشهر الحاليه ؟');
        if (!confirmation) {
            event.preventDefault();
        }
        }
    </script>
