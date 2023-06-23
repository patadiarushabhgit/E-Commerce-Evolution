<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ProductController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::redirect('/', '/admin/login', 301);

Route::redirect('/admin', '/admin/login', 301);


Route::controller(AuthController::class)->group(function () {

    Route::get('/admin/login', 'login')->name('adminlogin');
    Route::get('/admin/logout', 'logout')->name('logout');

});


Route::get('/admin/index', [IndexController::class, 'index'])->name('adminindex');


// //  Route::post('admin/login', [AuthController::class, 'validationForm'])->name('validateForm');
// Route::post('admin/login', [AuthController::class, 'registerForm'])->name('regForm');

// // Route::post('/login', [AuthController::class, 'validationForm'])->name('validateForm');
// // Route::post('/login', [AuthController::class, 'registerForm'])->name('regForm');

// Route::post('/login', 'AuthController@validateForm')->name('validateForm');
Route::get('/admin/login', [AuthController::class, 'login'])->name('adminlogin');
Route::post('admin/login', [AuthController::class,'validateLoginForm'])->name('validateLoginForm');
Route::post('admin/register', [AuthController::class,'validateRegForm'])->name('validateRegForm');
Route::get('logout', [AuthController::class,'logout'])->name('logout');



Route::resource('category',CategoryController::class);
Route::resource('user',UserController::class);
Route::resource('customer',CustomerController::class);
Route::post('api/fetch-state',[CustomerController::class,'fetchState'])->name('getStatesByCountry');
Route::post('api/fetch-cities',[CustomerController::class,'fetchCity'])->name('cities.getCitiesByState');


Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::post('/admin/edit_profile', [UserController::class, 'edit_profile'])->name('edit_profile');
Route::get('/admin/view_profile', [UserController::class, 'view_profile'])->name('view_profile');


Route::get('/admin/set_password', [UserController::class, 'set_password'])->name('set_password');
Route::post('/admin/category/get', [CategoryController::class, 'getCategory'])->name('category.getCategory');
Route::post('/admin/user/get', [UserController::class, 'getUser'])->name('user.getUser');
Route::post('/admin/customer/get', [CustomerController::class, 'getCustomer'])->name('customer.getCustomer');



Route::resource('/admin/products', ProductController::class);


