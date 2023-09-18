<style>
    .active {
        background: #c6d9f1;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link {{ Route::is('Reports.index') ? 'active' : '' }}" href="{{ route('Reports.index') }}">المرتبات</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('Reports.attendance') ? 'active' : '' }}" href="{{ route('Reports.attendance') }}">الحضور</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('Reports.report') ? 'active' : '' }}" href="{{ route('Reports.report') }}">التقرير</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('Reports.expenses') ? 'active' : '' }}" href="{{ route('Reports.expenses') }}">المصروفات</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('Reports.apposition') ? 'active' : '' }}" href="{{ route('Reports.apposition') }}">السلف</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('Reports.deduction') ? 'active' : '' }}" href="{{ route('Reports.deduction') }}">الخصومات</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('Reports.incentives') ? 'active' : '' }}" href="{{ route('Reports.incentives') }}">الحافز</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('Reports.bouns') ? 'active' : '' }}" href="{{ route('Reports.bouns') }}">الاضافي</a>
            </li>
        </ul>
    </div>
</nav>
