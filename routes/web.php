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
/**
 * WEB 2.0
 */
Route::get('/', 'App\Http\Livewire\Landing');
Route::get('/pendanaan', 'App\Http\Livewire\Client\Home');
Route::get('/pendanaan/{id}', 'App\Http\Livewire\Client\FundProduct');
Route::get('/login', 'App\Http\Livewire\Auth')->name('login'); 
Route::get('/about-us', 'App\Http\Livewire\AboutUs');
Route::get('/features', 'App\Http\Livewire\Features');
Route::get('/tutorial', 'App\Http\Livewire\Tutorial');
Route::get('/reset/{token}', 'App\Http\Livewire\Reset');
Route::get('/mulai', 'App\Http\Livewire\GetStarted')->middleware('auth');
Route::group(['middleware' => 'auth', 'middleware' => 'completed'], function () {
  Route::get('/notifikasi', 'App\Http\Livewire\Client\Notifications');
  Route::get('/profile', 'App\Http\Livewire\Client\Profile');
  Route::get('/portofolio', 'App\Http\Livewire\Client\Portofolio');
  Route::get('/transaksi', 'App\Http\Livewire\Client\Transactions');

  Route::get('/markas', 'App\Http\Livewire\Admin\Dashboard');
  Route::get('/markas/fund', 'App\Http\Livewire\Admin\FundProducts');
  Route::get('/markas/fund/{id}', 'App\Http\Livewire\Admin\FundProduct');
  Route::get('/markas/transaction', 'App\Http\Livewire\Admin\Transactions');
  Route::get('/markas/user', 'App\Http\Livewire\Admin\Users');
  Route::get('/markas/user/{id}', 'App\Http\Livewire\Admin\User');
  Route::get('/markas/vendor', 'App\Http\Livewire\Admin\Vendors');
  Route::get('/markas/vendor/{id}', 'App\Http\Livewire\Admin\Vendor');
});