<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;


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



Route::resource('category',CategoryController::class);
Route::resource('user',UserController::class);
Route::resource('customer',CustomerController::class);


