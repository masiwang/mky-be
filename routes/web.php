<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// use App\Http\Controllers\Web\AddressController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\FundCheckoutController;
use App\Http\Controllers\Web\FundProductController;
use App\Http\Controllers\Web\GettingStartedController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\NotificationController;
use App\Http\Controllers\Web\TransactionController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\FaqController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'login_save']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'registerSave']);
Route::get('/getting-started', [GettingStartedController::class, 'index'])->middleware('auth');
Route::post('/getting-started', [GettingStartedController::class, 'save'])->middleware('auth');

Route::get('/funding', [FundProductController::class, 'index'])->middleware('auth', 'profileiscomplete');
Route::get('/funding/{category}', [FundProductController::class, 'category'])->middleware('auth', 'profileiscomplete');
Route::get('/funding/{category}/{product}', [FundProductController::class, 'detail'])->middleware('auth', 'profileiscomplete');
Route::post('/funding/{category}/{product}', [FundProductController::class, 'newPortofolio'])->middleware('auth', 'profileiscomplete');

Route::get('/notification', [NotificationController::class, 'index']);
Route::get('/notification/{id}', [NotificationController::class, 'detail']);

Route::get('/transaction', [TransactionController::class, 'index'])->middleware('auth', 'profileiscomplete');
Route::get('/transaction/topup', [TransactionController::class, 'topup'])->middleware('auth', 'profileiscomplete');
Route::post('/transaction/topup', [TransactionController::class, 'topupSave'])->middleware('auth', 'profileiscomplete');
Route::get('/transaction/withdraw', [TransactionController::class, 'withdraw'])->middleware('auth', 'profileiscomplete');
Route::post('/transaction/withdraw', [TransactionController::class, 'withdrawSave'])->middleware('auth', 'profileiscomplete');

Route::get('/portofolio', [FundCheckoutController::class, 'index'])->middleware('auth', 'profileiscomplete');
Route::get('/portofolio/{invoice}', [FundCheckoutController::class, 'detail'])->middleware('auth', 'profileiscomplete');

Route::get('/profile', [UserController::class, 'index'])->middleware('auth', 'profileiscomplete');
Route::post('/profile', [UserController::class, 'update_save']);
Route::post('/profile/foto', [UserController::class, 'update_foto']);
Route::get_declared_classes('/faq', [FaqController::class, 'index']);

Route::get('/forgot', [AuthController::class, 'forgotViewEmail']);
Route::post('/forgot', [AuthController::class, 'forgotSaveEmail']);

Route::get('/forgot/reset', [AuthController::class, 'forgotViewPassword']);
Route::post('/forgot/reset', [AuthController::class, 'forgotSavePassword']);
