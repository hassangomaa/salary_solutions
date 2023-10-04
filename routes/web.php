<?php

use App\Http\Controllers\Exports\ExcelReportController;
use App\Http\Controllers\Safe\PaymentController;
use App\Models\Company;
use App\Models\Employee;
use App\Models\FollowUp;
use App\Models\Incentives;
use App\Models\TransactionLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Reports\ReportsController;
use App\Http\Controllers\Safe\SafeController;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Authentication


Route::middleware(['guest'])->group(function () {
    Route::get('/loginBlade', [AuthenticationController::class, 'loginBlade'])->name('loginBlade');
    // Route::get('/', [AuthenticationController::class, 'loginBlade'])->name('loginBlade');
    Route::post('/login', [AuthenticationController::class, 'login'])->name('login');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashborad');
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
    Route::get('/company_dashboard', [\App\Http\Controllers\CompanyController::class, 'companyDashboard'])->name('home');
});


Route::get('/setLanguage', [Controllers\LanguageController::class, 'update'])->name('setLanguage');



Route::group(['prefix' => 'company', 'as' => 'company.', 'middleware' => ['auth'], 'namespace' => 'Company'], function () {

    Route::get('/companyDashboard', [\App\Http\Controllers\CompanyController::class, 'companyDashboard'])->name('companyDashboard');
    Route::get('/index', [\App\Http\Controllers\CompanyController::class, 'index'])->name('index');
    Route::get('/indexBlade', [\App\Http\Controllers\CompanyController::class, 'indexBlade'])->name('indexBlade');
    Route::get('/show/{company}', [\App\Http\Controllers\CompanyController::class, 'show'])->name('show');
    Route::get('/create', [\App\Http\Controllers\CompanyController::class, 'create'])->name('create');
    Route::post('/store', [\App\Http\Controllers\CompanyController::class, 'store'])->name('store');
    Route::get('/edit/{company}', [\App\Http\Controllers\CompanyController::class, 'edit'])->name('edit');
    Route::put('/update/{company}', [\App\Http\Controllers\CompanyController::class, 'update'])->name('update');
    Route::delete('/destroy/{company}', [\App\Http\Controllers\CompanyController::class, 'destroy'])->name('destroy');
    Route::delete('/massDestroy', [\App\Http\Controllers\CompanyController::class, 'massDestroy'])->name('massDestroy');
    Route::get('/clickOnCompany/{id}', [\App\Http\Controllers\CompanyController::class, 'clickOnCompany'])->name('clickOnCompany');
    Route::get('/receiveMoneyBlade', [\App\Http\Controllers\CompanyController::class, 'receiveMoneyBlade'])->name('receiveMoneyBlade');
    Route::get('/clickToGenerateReport', [\App\Http\Controllers\ReportController::class, 'clickToGenerateReport'])->name('clickToGenerateReport');
});

Route::group(['prefix' => 'attendance', 'as' => 'attendance.', 'middleware' => ['auth']], function () {

    Route::get('/index', [\App\Http\Controllers\AttendanceController::class, 'index'])->name('index');
    Route::post('/updateNumberOfDays', [\App\Http\Controllers\AttendanceController::class, 'updateNumberOfDays'])->name('updateNumberOfDays');
    Route::get('/refreshData', [\App\Http\Controllers\AttendanceController::class, 'refreshData'])->name('refreshData');
    /*   Route::get('/show/{id}', [\App\Http\Controllers\AttendanceController::class, 'show'])->name('show');
    Route::get('/create/{employee}/{id}', [\App\Http\Controllers\AttendanceController::class, 'create'])->name('create');
    Route::post('/store', [\App\Http\Controllers\AttendanceController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [\App\Http\Controllers\AttendanceController::class, 'edit'])->name('edit');
    Route::put('/update', [\App\Http\Controllers\AttendanceController::class, 'update'])->name('update');
    Route::delete('/destroy/{followUp}', [\App\Http\Controllers\AttendanceController::class, 'destroy'])->name('destroy');
    Route::delete('/massDestroy', [\App\Http\Controllers\AttendanceController::class, 'massDestroy'])->name('massDestroy');*/
});

Route::group(['prefix' => 'extraHours', 'as' => 'extraHours.', 'middleware' => ['auth']], function () {

    Route::get('/index', [\App\Http\Controllers\ExtraHoursController::class, 'index'])->name('index');
    Route::post('/updateNumberOfHours', [\App\Http\Controllers\ExtraHoursController::class, 'updateNumberOfHours'])->name('updateNumberOfHours');
});

Route::group(['prefix' => 'incentive', 'as' => 'incentive.', 'middleware' => ['auth']], function () {

    Route::get('/index', [\App\Http\Controllers\IncentiveController::class, 'index'])->name('index');
    Route::post('/addIncentives', [\App\Http\Controllers\IncentiveController::class, 'addIncentives'])->name('addIncentives');
    Route::get('/refreshData', [\App\Http\Controllers\IncentiveController::class, 'refreshData'])->name('refreshData');
});

Route::group(['prefix' => 'deduction', 'as' => 'deduction.', 'middleware' => ['auth']], function () {

    Route::get('/index', [\App\Http\Controllers\DeductionController::class, 'index'])->name('index');
    Route::post('/addDeduction', [\App\Http\Controllers\DeductionController::class, 'addDeduction'])->name('addDeduction');
    Route::get('/refreshData', [\App\Http\Controllers\DeductionController::class, 'refreshData'])->name('refreshData');
});

Route::group(['prefix' => 'transactionLog', 'as' => 'transactionLog.', 'middleware' => ['auth']], function () {

    Route::get('/index', [\App\Http\Controllers\TransactionLogController::class, 'index'])->name('index');
    Route::get('/show/{id}', [\App\Http\Controllers\TransactionLogController::class, 'show'])->name('show');
    Route::delete('/destroy/{transactionLog}', [\App\Http\Controllers\TransactionLogController::class, 'destroy'])->name('destroy');
    Route::delete('/massDestroy', [\App\Http\Controllers\TransactionLogController::class, 'massDestroy'])->name('massDestroy');
});

/*
Route::group(['prefix' => 'incentive', 'as' => 'incentive.', 'middleware' => ['auth']/*, 'namespace' => 'Attendance'], function () {

    Route::get('/index', [\App\Http\Controllers\IncentiveController::class, 'index'])->name('index');
    Route::get('/show/{id}', [\App\Http\Controllers\IncentiveController::class, 'show'])->name('show');
    Route::get('/create/{employee}/{id}', [\App\Http\Controllers\IncentiveController::class, 'create'])->name('create');
    Route::post('/store', [\App\Http\Controllers\IncentiveController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [\App\Http\Controllers\IncentiveController::class, 'edit'])->name('edit');
    Route::put('/update', [\App\Http\Controllers\IncentiveController::class, 'update'])->name('update');
    Route::delete('/destroy/{followUp}', [\App\Http\Controllers\IncentiveController::class, 'destroy'])->name('destroy');
    Route::delete('/massDestroy', [\App\Http\Controllers\IncentiveController::class, 'massDestroy'])->name('massDestroy');
});*/
Route::group(['prefix' => 'borrowing', 'as' => 'borrowing.', 'middleware' => ['auth']], function () {

    Route::get('/index', [\App\Http\Controllers\BorrowingController::class, 'index'])->name('index');
    Route::get('/show/{borrow}', [\App\Http\Controllers\BorrowingController::class, 'show'])->name('show');
    Route::get('/create', [\App\Http\Controllers\BorrowingController::class, 'create'])->name('create');
    Route::post('/store', [\App\Http\Controllers\BorrowingController::class, 'store'])->name('store');
    Route::get('/edit/{borrow}', [\App\Http\Controllers\BorrowingController::class, 'edit'])->name('edit');
    Route::put('/update/{borrow}', [\App\Http\Controllers\BorrowingController::class, 'update'])->name('update');
    Route::delete('/destroy/{borrow}', [\App\Http\Controllers\BorrowingController::class, 'destroy'])->name('destroy');
    Route::delete('/massDestroy', [\App\Http\Controllers\BorrowingController::class, 'massDestroy'])->name('massDestroy');
});
Route::controller(ExcelReportController::class)->prefix('excels')->group(function () {
    Route::get('salaries', 'salariesExport')->name('excels.salaries_export');
});

Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => ['auth']/*, 'namespace' => 'Users'*/], function () {

    Route::get('/index', [\App\Http\Controllers\UsersController::class, 'index'])->name('index');
    Route::get('/getUsersForAttendance', [\App\Http\Controllers\UsersController::class, 'getUsersForAttendance'])->name('getUsersForAttendance');
    Route::get('/attendEmployee/{employeeId}', [\App\Http\Controllers\UsersController::class, 'attendEmployee'])->name('attendEmployee');

    Route::get('/show/{userId}', [\App\Http\Controllers\UsersController::class, 'show'])->name('show');
    Route::get('/create', [\App\Http\Controllers\UsersController::class, 'create'])->name('create');
    Route::post('/store', [\App\Http\Controllers\UsersController::class, 'store'])->name('store');
    Route::get('/edit/{userId}', [\App\Http\Controllers\UsersController::class, 'edit'])->name('edit');
    Route::put('/update/{userId}', [\App\Http\Controllers\UsersController::class, 'update'])->name('update');
    Route::delete('/destroy/{userId}', [\App\Http\Controllers\UsersController::class, 'destroy'])->name('destroy');
    Route::delete('/massDestroy', [\App\Http\Controllers\UsersController::class, 'massDestroy'])->name('massDestroy');
});


Route::group(['prefix' => 'employee', 'as' => 'employee.', 'middleware' => ['auth'], 'namespace' => 'Employee'], function () {

    Route::get('/getAllEmployees', [\App\Http\Controllers\EmployeeController::class, 'getAllEmployees'])->name('getAllEmployees');
    Route::get('/importEmployeesBlade', [\App\Http\Controllers\EmployeeController::class, 'importEmployeesBlade'])->name('importEmployeesBlade');
    Route::post('/importEmployees', [\App\Http\Controllers\EmployeeController::class, 'importEmployees'])->name('importEmployees');
    Route::get('/index', [\App\Http\Controllers\EmployeeController::class, 'index'])->name('index');
    Route::get('/show/{employee}', [\App\Http\Controllers\EmployeeController::class, 'show'])->name('show');
    Route::get('/create', [\App\Http\Controllers\EmployeeController::class, 'create'])->name('create');
    Route::post('/store', [\App\Http\Controllers\EmployeeController::class, 'store'])->name('store');
    Route::get('/edit/{employee}', [\App\Http\Controllers\EmployeeController::class, 'edit'])->name('edit');
    Route::put('/update/{employee}', [\App\Http\Controllers\EmployeeController::class, 'update'])->name('update');
    Route::delete('/destroy/{employee}', [\App\Http\Controllers\EmployeeController::class, 'destroy'])->name('destroy');
    Route::delete('/massDestroy', [\App\Http\Controllers\EmployeeController::class, 'massDestroy'])->name('massDestroy');
});

Route::group(['prefix' => 'companyPayments', 'as' => 'companyPayments.', 'middleware' => ['auth'], 'namespace' => 'Company'], function () {
    Route::get('/index', [\App\Http\Controllers\CompanyPaymentsController::class, 'index'])->name('index');
    Route::get('/show/{deposit}', [\App\Http\Controllers\CompanyPaymentsController::class, 'show'])->name('show');
    Route::get('/create', [\App\Http\Controllers\CompanyPaymentsController::class, 'create'])->name('create');
    Route::post('/store', [\App\Http\Controllers\CompanyPaymentsController::class, 'store'])->name('store');
    Route::get('/edit/{deposit}', [\App\Http\Controllers\CompanyPaymentsController::class, 'edit'])->name('edit');
    Route::put('/update/{deposit}', [\App\Http\Controllers\CompanyPaymentsController::class, 'update'])->name('update');
    Route::delete('/destroy/{deposit}', [\App\Http\Controllers\CompanyPaymentsController::class, 'destroy'])->name('destroy');
    Route::delete('/massDestroy', [\App\Http\Controllers\CompanyPaymentsController::class, 'massDestroy'])->name('massDestroy');
});

Route::group(['prefix' => 'commission', 'as' => 'commission.', 'middleware' => ['auth'],], function () {
    Route::get('/index/{id}', [\App\Http\Controllers\CommissionController::class, 'index'])->name('index');
    Route::get('/show/{commission}', [\App\Http\Controllers\CommissionController::class, 'show'])->name('show');
    Route::get('/create/{employeeId}', [\App\Http\Controllers\CommissionController::class, 'create'])->name('create');
    Route::post('/store', [\App\Http\Controllers\CommissionController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [\App\Http\Controllers\CommissionController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [\App\Http\Controllers\CommissionController::class, 'update'])->name('update');
    Route::delete('/destroy/{commission}', [\App\Http\Controllers\CommissionController::class, 'destroy'])->name('destroy');
    Route::delete('/massDestroy', [\App\Http\Controllers\CommissionController::class, 'massDestroy'])->name('massDestroy');
});


Route::group(['prefix' => 'excel', 'as' => 'excel.', 'middleware' => ['auth'],], function () {
    Route::get('/index', [\App\Http\Controllers\ExcelController::class, 'index'])->name('index');
    Route::get('/downloadFile/{id}', [\App\Http\Controllers\ExcelController::class, 'downloadFile'])->name('downloadFile');
    Route::get('/downloadImportEmployeeTemplate', [\App\Http\Controllers\ExcelController::class, 'downloadImportEmployeeTemplate'])->name('downloadImportEmployeeTemplate');
});

Route::group(['prefix' => 'Reports', 'as' => 'Reports.', 'middleware' => ['auth'],], function () {
    Route::get('/index', [ReportsController::class, 'index'])->name('index');
    Route::get('/attendance', [ReportsController::class, 'attendance'])->name('attendance');
    Route::get('/report', [ReportsController::class, 'report'])->name('report');
    Route::get('/expenses', [ReportsController::class, 'expenses'])->name('expenses');
    Route::get('/apposition', [ReportsController::class, 'apposition'])->name('apposition');
    Route::get('/deduction', [ReportsController::class, 'deduction'])->name('deduction');
    Route::get('/incentives', [ReportsController::class, 'incentives'])->name('incentives');
    Route::get('/bouns', [ReportsController::class, 'bouns'])->name('bouns');
    Route::get('/safe-transactions', [ReportsController::class, 'safe_transactions'])->name('safe_transactions');

    // Route::get('/downloadFile/{id}', [\App\Http\Controllers\ExcelController::class, 'downloadFile'])->name('downloadFile');

});

Route::controller(SafeController::class)->prefix('safes')->group(function () {
    Route::get('index', 'index')->name('safes.index');
    Route::get('create', 'create')->name('safes.create');
    Route::get('show', 'show')->name('safes.show');
    Route::post('store', 'store')->name('safes.store');

    Route::get('edit/{id}', 'edit')->name('safes.edit');
    Route::post('update/{id}', 'update')->name('safes.update');
    Route::get('destroy/{id}', 'destroy')->name('safes.destroy');
    Route::get('transactions/{id}', 'transactions')->name('safes.transactions');
    Route::get('safe_transfer', 'safe_transfer_create')->name('safes.safe_transfer.create');
    Route::post('safe_transfer', 'safe_transfer_store')->name('safes.safe_transfer_store');
});

Route::controller(PaymentController::class)->prefix('payment')->group(function () {
    Route::get('/salary_pay', '__invoke')->name('salary_pay');
});

Route::get('/test', function () {
    $employee = Employee::with('company')->where('id', 1)->first();
    $log = new TransactionLog();


    return $employee->company->id;
});
Route::get('/test2', function () {
    $report = new Controllers\ReportController();
    $report->calculateMonthlyReport(1, 9, 2023);
    Controllers\ExcelController::generateExcelFile(1, 9, 2023);
});


###################################################


//Route::get('/en', function () {
//    return view('welcome');
//})->name('welcome');
//Route::get('/', function () {
//    return view('welcome_ar')
//    ;
//})->name('welcome_ar');


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']/*, 'namespace' => 'Admin'*/], function () {
    Route::get('/', [\App\Http\Controllers\EmployeeController::class, 'index'])->name('home');
    // Permissions //Working
    Route::delete('permissions/destroy', [Controllers\PermissionsController::class, 'massDestroy'])->name('permissions.massDestroy');
    Route::resource('permissions', Controllers\PermissionsController::class);

    // Roles
    Route::delete('roles/destroy', [Controllers\RolesController::class, 'massDestroy'])->name('roles.massDestroy');
    Route::resource('roles', \App\Http\Controllers\RolesController::class);

    //    //// Users //Dont use it
    //    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    //    Route::resource('users', Controllers\UsersController::class);

    //    //salaries
    //    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    //    Route::resource('users', 'UsersController');
    // Products


});
