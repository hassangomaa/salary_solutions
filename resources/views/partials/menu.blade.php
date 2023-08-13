<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <div class="d-flex justify-content-center">
        <a href="#" class="brand-link">
            <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
        </a>
    </div>


    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if(\App\Http\Controllers\CompanyController::$companyId == null)

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
                            Companies Management
                        </p>
                    </a>
                </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs("employee.index") ? "active" : "" }}"
                           href="{{ route("employee.index") }}">
                            <i class="fas fa-fw fa-tachometer-alt nav-icon">
                            </i>
                            <p>
                                Show Employees
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs("company.index") ? "active" : "" }}"
                           href="{{ route("company.index") }}">
                            <i class="fas fa-fw fa-tachometer-alt nav-icon">
                            </i>
                            <p>
                               Back To Companies
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
{{--                @can('user_management_access')--}}
{{--                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }}">--}}
{{--                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/permissions*") ? "active" : "" }} {{ request()->is("admin/roles*") ? "active" : "" }} {{ request()->is("admin/users*") ? "active" : "" }}"--}}
{{--                           href="#">--}}
{{--                            <i class="fa-fw nav-icon fas fa-users">--}}

{{--                            </i>--}}
{{--                            <p>--}}
{{--                                {{ trans('cruds.userManagement.title') }}--}}
{{--                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                        <ul class="nav nav-treeview">--}}
{{--                            @can('permission_access')--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="{{ route("admin.permissions.index") }}"--}}
{{--                                       class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">--}}
{{--                                        <i class="fa-fw nav-icon fas fa-unlock-alt">--}}

{{--                                        </i>--}}
{{--                                        <p>--}}
{{--                                            {{ trans('cruds.permission.title') }}--}}
{{--                                        </p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            @endcan--}}
{{--                            @can('role_access')--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="{{ route("admin.roles.index") }}"--}}
{{--                                       class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">--}}
{{--                                        <i class="fa-fw nav-icon fas fa-briefcase">--}}

{{--                                        </i>--}}
{{--                                        <p>--}}
{{--                                            {{ trans('cruds.role.title') }}--}}
{{--                                        </p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            @endcan--}}
{{--                            @can('user_access')--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="{{ route("admin.users.index") }}"--}}
{{--                                       class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">--}}
{{--                                        <i class="fa-fw nav-icon fas fa-user">--}}

{{--                                        </i>--}}
{{--                                        <p>--}}
{{--                                            {{ trans('cruds.user.title') }}--}}
{{--                                        </p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            @endcan--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                @endcan--}}
{{--                @can('product_access')--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{ route("admin.products.index") }}"--}}
{{--                           class="nav-link {{ request()->is("admin/products") || request()->is("admin/products/*") ? "active" : "" }}">--}}
{{--                            <i class="fa-fw nav-icon fab fa-product-hunt">--}}

{{--                            </i>--}}
{{--                            <p>--}}
{{--                                {{ trans('cruds.product.title') }}--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                @endcan--}}

{{--                @can('brand_access')--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{ route("admin.brands.index") }}"--}}
{{--                           class="nav-link {{ request()->is("admin/brands") || request()->is("admin/brands/*") ? "active" : "" }}">--}}
{{--                            <i class="fa-fw nav-icon fas fa-cogs">--}}

{{--                            </i>--}}
{{--                            <p>--}}
{{--                                {{ trans('cruds.brand.title') }}--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                @endcan--}}
{{--                @can('modeel_access')--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{ route("admin.modeels.index") }}"--}}
{{--                           class="nav-link {{ request()->is("admin/modeels") || request()->is("admin/modeels/*") ? "active" : "" }}">--}}
{{--                            <i class="fa-fw nav-icon fas fa-cogs">--}}
{{--                            </i>--}}
{{--                            <p>--}}
{{--                                {{ trans('cruds.modeel.title') }}--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                @endcan--}}
{{--                @can('year_access')--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{ route("admin.years.index") }}"--}}
{{--                           class="nav-link {{ request()->is("admin/years") || request()->is("admin/years/*") ? "active" : "" }}">--}}
{{--                            <i class="fa-fw nav-icon fas fa-cogs">--}}

{{--                            </i>--}}
{{--                            <p>--}}
{{--                                {{ trans('cruds.year.title') }}--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                @endcan--}}
{{--                @can('engine_capacity_cc_access')--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{ route("admin.engine-capacity-ccs.index") }}"--}}
{{--                           class="nav-link {{ request()->is("admin/engine-capacity-ccs") || request()->is("admin/engine-capacity-ccs/*") ? "active" : "" }}">--}}
{{--                            <i class="fa-fw nav-icon fas fa-cogs">--}}

{{--                            </i>--}}
{{--                            <p>--}}
{{--                                {{ trans('cruds.engineCapacityCc.title') }}--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                @endcan--}}
{{--                @can('service_access')--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{ route("admin.services.index") }}"--}}
{{--                           class="nav-link {{ request()->is("admin/services") || request()->is("admin/services/*") ? "active" : "" }}">--}}
{{--                            <i class="fa-fw nav-icon fas fa-cogs">--}}

{{--                            </i>--}}
{{--                            <p>--}}
{{--                                {{ trans('cruds.service.title') }}--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                @endcan--}}
{{--                @can('variation_access')--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{ route("admin.variations.index") }}"--}}
{{--                           class="nav-link {{ request()->is("admin/variations") || request()->is("admin/variations/*") ? "active" : "" }}">--}}
{{--                            <i class="fa-fw nav-icon fas fa-cogs">--}}

{{--                            </i>--}}
{{--                            <p>--}}
{{--                                {{ trans('cruds.variation.title') }}--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                @endcan--}}
{{--                @php($unread = \App\Models\QaTopic::unreadCount())--}}

{{--                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))--}}
{{--                    @can('profile_password_edit')--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}"--}}
{{--                               href="{{ route('profile.password.edit') }}">--}}
{{--                                <i class="fa-fw fas fa-key nav-icon">--}}
{{--                                </i>--}}
{{--                                <p>--}}
{{--                                    {{ trans('global.change_password') }}--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}
{{--                @endif--}}

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
