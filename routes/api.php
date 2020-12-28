<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Admin Area
 */
use App\Http\Controllers\Admin\AuthController as Auth_;
use App\Http\Controllers\Admin\DashboardController as Dashboard_;
use App\Http\Controllers\Admin\FileController as File_;
use App\Http\Controllers\Admin\FundCheckoutController as FundCheckout_;
use App\Http\Controllers\Admin\FundProductController as FundProduct_;
use App\Http\Controllers\Admin\InvestorController as Investor_;
use App\Http\Controllers\Admin\NotificationController as Notification_;
use App\Http\Controllers\Admin\TransactionController as Transaction_;
use App\Http\Controllers\Admin\UserController as User_;
use App\Http\Controllers\Admin\VendorController as Vendor_;

Route::post('/admin/login', [Auth_::class, 'loginSave']);
Route::post('/admin/refresh', [Auth_::class, 'refreshToken'])->middleware('auth:api');
Route::post('/admin/logout', [Auth_::class, 'logout'])->middleware('auth:api');

Route::group(['prefix' => 'admin', 'middleware' => 'auth:api'], function () {
  // per page
  Route::get('dashboard', [Dashboard_::class, 'index']);
    // fund product
    Route::get('fund-product', [FundProduct_::class, 'index']);
    Route::post('fund-product', [FundProduct_::class, 'new']);
    Route::post('fund-product/new-report', [FundProduct_::class, 'newReport']);
    Route::get('fund-product/{id}', [FundProduct_::class, 'detail']);
    Route::post('fund-product/{id}', [FundProduct_::class, 'edit']);
    // fund checkout (portofolio)
    Route::post('fund-checkout/send-invoice', [FundCheckout_::class, 'sendInvoice']);
    Route::post('fund-checkout/send-return', [FundCheckout_::class, 'sendReturn']);
    // investor (user)
    Route::get('investor', [Investor_::class, 'index']);
    Route::get('investor/{id}', [Investor_::class, 'detail']);
    Route::post('investor/{id}/confirm', [Investor_::class, 'ktpConfirmSave']);
    // notifikasi
    Route::get('notification', [Notification_::class, 'index']);
    Route::get('notification/{id}', [Notification_::class, 'detail']);
    // transaksi
    Route::get('transaction', [Transaction_::class, 'index']);
    Route::post('transaction/confirm', [Transaction_::class, 'confirm']);
    Route::post('transaction/reject', [Transaction_::class, 'reject']);
    // user (admin)
    Route::get('user', [User_::class, 'getUser']);
    // vendor (mitra)
    Route::get('vendor', [Vendor_::class, 'index']);
    Route::post('vendor', [Vendor_::class, 'store']);
    Route::get('vendor/{id}', [Vendor_::class, 'detail']);
    // upload handler
    Route::post('upload/image', [File_::class, 'image']);
});

use App\Http\Controllers\Apps\FundProductController as AppFundProduct;
use App\Http\Controllers\Apps\FundCheckoutController as AppFundCheckout;
use App\Http\Controllers\Apps\NotificationController as AppNotification;
use App\Http\Controllers\Apps\UserController as AppUser;

Route::post('/login', [AppUser::class, 'doLogin']);
Route::post('/forgot', [AppUser::class, 'forgotPost']);
Route::post('/forgot/reset', [AppUser::class, 'resetPassword']);
Route::post('/logout', [AppUser::class, 'logout'])->middleware('auth:api');
Route::post('/refresh', [AppUser::class, 'doRefresh'])->middleware('auth:api');
Route::get('/user', [AppUser::class, 'getUser'])->middleware('auth:api');
Route::get('/fund-product', [AppFundProduct::class, 'index'])->middleware('auth:api');
Route::get('/portofolio', [AppFundCheckout::class, 'portofolio'])->middleware('auth:api');
Route::get('/notification', [AppNotification::class, 'notification'])->middleware('auth:api');
Route::get('/profile', [AppUser::class, 'profile'])->middleware('auth:api');

use App\Http\Controllers\API\UserController as UserApi;
use App\Http\Controllers\API\FundProductController as FundProductApi;
use App\Http\Controllers\API\NotificationController as NotificationApi;
use App\Http\Controllers\API\PortofolioController as PortofolioApi;
use App\Http\Controllers\API\TransactionController as TransactionApi;
use App\Http\Controllers\API\FundProductReportController as FundReportApi;
Route::get('/admin/v2/user', [UserApi::class, 'index']);
Route::get('/admin/v2/user/{id}/portofolio', [UserApi::class, 'portofolios']);
Route::get('/admin/v2/user/{id}/transaction', [UserApi::class, 'transaction']);

Route::get('/admin/v2/fund-product', [FundProductApi::class, 'index']);
Route::get('/admin/v2/fund-product/{id}', [FundProductApi::class, 'show']);
Route::post('/admin/v2/fund-product/{id}', [FundProductApi::class, 'update']);

Route::post('/admin/v2/portofolio', [PortofolioApi::class, 'store']);

Route::get('/admin/v2/portofolio/{id}', [PortofolioApi::class, 'show']);
Route::post('/admin/v2/portofolio/{id}', [PortofolioApi::class, 'update']);
Route::delete('/admin/v2/portofolio/{id}', [PortofolioApi::class, 'destroy']);

Route::post('/admin/v2/transaction', [TransactionApi::class, 'store']);
Route::delete('/admin/v2/transaction/{id}', [TransactionApi::class, 'destroy']);

// user
Route::get('/v2/fund-product', [FundProductApi::class, 'index']);
Route::get('/v2/fund-product/{id}', [FundProductApi::class, 'show']);
Route::get('/v2/fund-report/{id}', [FundReportApi::class, 'show']);
Route::get('/v2/user/{user_id}/portofolio', [UserApi::class, 'portofolios']);
Route::get('/v2/user/{user_id}/notification', [UserApi::class, 'notifications']);

Route::get('/v2/user/{user_id}/portofolio/{portofolio_id}', [UserApi::class, 'portofolio']); // salah
Route::get('/v2/user/{user_id}/portofolio/{portofolio_id}/report/{report_id}', [UserApi::class, 'portofolio']); // salah

Route::get('/v2/notification/{id}', [NotificationApi::class, 'show']);
Route::post('/v2/portofolio', [PortofolioApi::class, 'store_']);
Route::get('/v2/portofolio/{id}', [PortofolioApi::class, 'show']);