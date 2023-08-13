<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;

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
Route::get('/loginBlade',[AuthenticationController::class,'loginBlade'])->name('loginBlade');
Route::post('/login',[AuthenticationController::class,'login'])->name('login');
Route::post('/logout',[AuthenticationController::class,'logout'])->name('logout');



Route::group(['prefix' => 'company', 'as' => 'company.','middleware'=>['auth'], 'namespace' => 'Company'], function (){

    Route::get('/companyDashboard',[\App\Http\Controllers\CompanyController::class,'companyDashboard'])->name('companyDashboard');
    Route::get('/index',[\App\Http\Controllers\CompanyController::class,'index'])->name('index');
    Route::get('/indexBlade',[\App\Http\Controllers\CompanyController::class,'indexBlade'])->name('indexBlade');
    Route::get('/show/{company}',[\App\Http\Controllers\CompanyController::class,'show'])->name('show');
    Route::get('/create',[\App\Http\Controllers\CompanyController::class,'create'])->name('create');
    Route::post('/store',[\App\Http\Controllers\CompanyController::class,'store'])->name('store');
    Route::get('/edit/{company}',[\App\Http\Controllers\CompanyController::class,'edit'])->name('edit');
    Route::put('/update/{company}',[\App\Http\Controllers\CompanyController::class,'update'])->name('update');
    Route::delete('/destroy/{company}',[\App\Http\Controllers\CompanyController::class,'destroy'])->name('destroy');
    Route::delete('/massDestroy',[\App\Http\Controllers\CompanyController::class,'massDestroy'])->name('massDestroy');



});


//Route::get('/en', function () {
//    return view('welcome');
//})->name('welcome');
//Route::get('/', function () {
//    return view('welcome_ar')
//    ;
//})->name('welcome_ar');


/*Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
    Route::get('/', [\App\Http\Controllers\EmployeeController::class,'index'])->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

//    //salaries
//    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
//    Route::resource('users', 'UsersController');
    // Products
    Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');
    Route::resource('products', 'ProductsController');

    // Categories
    Route::delete('categories/destroy', 'CategoriesController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoriesController');

    // Details
    Route::delete('details/destroy', 'DetailsController@massDestroy')->name('details.massDestroy');
    Route::resource('details', 'DetailsController');

    // Variation
    Route::delete('variations/destroy', 'VariationController@massDestroy')->name('variations.massDestroy');
    Route::resource('variations', 'VariationController');

    // Service
    Route::delete('services/destroy', 'ServiceController@massDestroy')->name('services.massDestroy');
    Route::resource('services', 'ServiceController');

    // Images
    Route::delete('images/destroy', 'ImagesController@massDestroy')->name('images.massDestroy');
    Route::resource('images', 'ImagesController', ['except' => ['show']]);

    // Brand
    Route::delete('brands/destroy', 'BrandController@massDestroy')->name('brands.massDestroy');
    Route::resource('brands', 'BrandController');

    // Modeel
    Route::delete('modeels/destroy', 'ModeelController@massDestroy')->name('modeels.massDestroy');
    Route::resource('modeels', 'ModeelController');

    // Year
    Route::delete('years/destroy', 'YearController@massDestroy')->name('years.massDestroy');
    Route::resource('years', 'YearController');

    // Engine Capacity Cc
    Route::delete('engine-capacity-ccs/destroy', 'EngineCapacityCcController@massDestroy')->name('engine-capacity-ccs.massDestroy');
    Route::resource('engine-capacity-ccs', 'EngineCapacityCcController');

    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});*/

Route::group(['prefix' => 'employee', 'as' => 'employee.','middleware'=>['auth'], 'namespace' => 'Employee'], function (){

    Route::get('/index',[\App\Http\Controllers\EmployeeController::class,'index'])->name('index');
    Route::get('/show/{employee}',[\App\Http\Controllers\EmployeeController::class,'show'])->name('show');
    Route::get('/create',[\App\Http\Controllers\EmployeeController::class,'create'])->name('create');
    Route::post('/store',[\App\Http\Controllers\EmployeeController::class,'store'])->name('store');
    Route::get('/edit/{employee}',[\App\Http\Controllers\EmployeeController::class,'edit'])->name('edit');
    Route::put('/update/{employee}',[\App\Http\Controllers\EmployeeController::class,'update'])->name('update');
    Route::delete('/destroy/{employee}',[\App\Http\Controllers\EmployeeController::class,'destroy'])->name('destroy');
    Route::delete('/massDestroy',[\App\Http\Controllers\EmployeeController::class,'massDestroy'])->name('massDestroy');



});



Route::get('/test',function ($a)
{
    echo 'anything' . $a;
})->name('test');
