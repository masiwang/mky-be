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
use App\Http\Controllers\API\v1\AddressController;
use App\Http\Controllers\API\v1\FileController;
use App\Http\Controllers\API\v1\FundController;
use App\Http\Controllers\API\v1\FundCheckoutController;
use App\Http\Controllers\API\v1\TransactionController;
use App\Http\Controllers\API\v1\UpdaterController;
use App\Http\Controllers\API\v1\UserController;

use App\Http\Controllers\User\AddressController as UserAddress;
Route::group(['prefix' => 'v1'], function () {
    // guest
    Route::get('guestfund', [FundController::class, 'product_guest']);
    // alamat
    Route::get('provinsi', [AddressController::class, 'provinsi']);
    Route::get('kabupaten', [AddressController::class, 'kabupaten']);
    Route::get('kecamatan', [AddressController::class, 'kecamatan']);
    Route::get('kelurahan', [AddressController::class, 'kelurahan']);
    Route::get('kodepos', [AddressController::class, 'kodepos']);
    // apps update
    Route::get('update', [UpdaterController::class, 'check_update']);
    // auth user
    Route::post('login', [UserController::class, 'login']);
    Route::post('register', [UserController::class, 'register']);
    Route::get('refresh', [UserController::class, 'refresh']);
    Route::group(['middleware' => 'auth:api'], function () {
        // user
        Route::get('user', [UserController::class, 'user']);
        Route::post('user', [UserController::class, 'user_edit']);
        Route::post('getstarted', [UserController::class, 'get_started']);
        // fund
        Route::get('fund', [FundController::class, 'product']);
        Route::get('fund/{id}', [FundController::class, 'product_detail']);
        //fund checkout aka portofolio
        Route::get('portofolio', [FundCheckoutController::class, 'portofolio']);
        Route::post('portofolio', [FundCheckoutController::class, 'new_portofolio']);
        // transaction
        Route::get('saldo', [TransactionController::class, 'saldo']);
        Route::get('transaction', [TransactionController::class, 'transaction']);
        Route::post('topup', [TransactionController::class, 'topup']);
        Route::post('withdraw', [TransactionController::class, 'withdraw']);
        // upload
        Route::post('upload', [FileController::class, 'upload']);
    });

    Route::get('/address', [UserAddress::class, 'getProvinsi']);
    Route::get('/address/{provinsi}', [UserAddress::class, 'getKabupaten']);
    Route::get('/address/{provinsi}/{kabupaten}', [UserAddress::class, 'getKecamatan']);
    Route::get('/address/{provinsi}/{kabupaten}/{kecamatan}', [UserAddress::class, 'getKelurahan']);
    Route::get('/address/{provinsi}/{kabupaten}/{kecamatan}/{kelurahan}', [UserAddress::class, 'getKodepos']);
});
/**
 * Admin Area
 */
use App\Http\Controllers\Admin\AuthController as Auth_;
use App\Http\Controllers\Admin\DashboardController as Dashboard_;
use App\Http\Controllers\Admin\FileController as File_;
use App\Http\Controllers\Admin\FundCheckoutController as FundCheckout_;
use App\Http\Controllers\Admin\FundProductController as FundProduct_;
use App\Http\Controllers\Admin\NotificationController as Notification_;
use App\Http\Controllers\Admin\TransactionController as Transaction_;
use App\Http\Controllers\Admin\UserController as User_;
use App\Http\Controllers\Admin\VendorController as Vendor_;
Route::post('/admin/login', [Auth_::class, 'loginSave']);
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
    // notifikasi
    Route::get('notification', [Notification_::class, 'index']);
    Route::get('notification/{id}', [Notification_::class, 'detail']);
    // transaksi
    Route::get('transaction', [Transaction_::class, 'index']);
    Route::post('transaction/confirm', [Transaction_::class, 'confirm']);
    // user (investor)
    Route::get('user', [User_::class, 'index']);
    Route::get('user/{id}', [User_::class, 'detail']);
    // vendor (mitra)
    Route::get('vendor', [Vendor_::class, 'index']);
    Route::get('vendor/{id}', [Vendor_::class, 'detail']);
    // upload handler
    Route::post('upload/image', [File_::class, 'image']);
});