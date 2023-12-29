<?php

use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OtpVerificationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;


//auth routes
Route::middleware('guest')->controller(RegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::get('/loginView', 'loginView')->name('loginView');
    Route::get('/', 'loginView')->name('loginView');
    Route::post('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
});

Route::get('/otp/verify', [OtpVerificationController::class, 'showVerificationForm'])->name('otp.verify');
Route::post('verifyOtp', [OtpVerificationController::class, 'verifyOtp'])->name('verifyOtp');


Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');

//dashboard
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});


Route::get('/createUser', [UserController::class, 'createUser'])->name('createUser');
Route::post('/addUser', [UserController::class, 'addUser'])->name('addUser');
Route::get('/viewUser', [UserController::class, 'viewUser'])->name('viewUser');
Route::delete('/deleteUser/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');
Route::get('/editUser/{id}', [UserController::class, 'editUser'])->name('editUser');
Route::post('/updateUser', [UserController::class, 'updateUser'])->name('updateUser');


Route::group(['middleware' => ['can:category_module']], function () {  // access to sales team only
    Route::get('/createCategory', [CategoryController::class, 'createCategory'])->name('createCategory');
    Route::post('/addCategory', [CategoryController::class, 'addCategory'])->name('addCategory');
    Route::get('/viewCategory', [CategoryController::class, 'viewCategory'])->name('viewCategory');
    Route::delete('/deleteCategory/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
});


Route::group(['middleware' => ['can:product_module']], function () {  // access to sales team only
    Route::get('/createProduct', [ProductController::class, 'createProduct'])->name('createProduct');
    Route::post('/addProduct', [ProductController::class, 'addProduct'])->name('addProduct');
    Route::get('/viewProduct', [ProductController::class, 'viewProduct'])->name('viewProduct');
    Route::delete('/deleteProduct/{id}', [ProductController::class, 'deleteProduct'])->name('deleteProduct');
});

Route::get('/export-excel', [ExcelController::class, 'export'])->name('export-excel');
Route::get('/download-csv', [CsvController::class, 'downloadCsv'])->name('download-csv');;
