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
Route::group(['prefix' => 'v1'], function () {
    Route::post('login', [UserController::class, 'login']);
    Route::post('register', [UserController::class, 'register']);
    Route::get('guestfund', [FundController::class, 'product_guest']);
    Route::get('provinsi', [AddressController::class, 'provinsi']);
    Route::get('kabupaten', [AddressController::class, 'kabupaten']);
    Route::get('kecamatan', [AddressController::class, 'kecamatan']);
    Route::get('kelurahan', [AddressController::class, 'kelurahan']);
    Route::get('kodepos', [AddressController::class, 'kodepos']);
    Route::get('bank', [TransactionController::class, 'bank']);
    Route::get('update', [UpdaterController::class, 'check_update']);
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
});
