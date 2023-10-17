<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PengaduanController;

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


Route::name('frontend')->group(function() {
    Route::get('/', function () {
        return view('frontend.landing-page');
    });

});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login_action'])->name('login.action');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'register_action'])->name('register.action');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('backend')->group(function () {
    // admin
    Route::group(['middleware' => ['auth', 'OnlyAdmin'],'prefix' => 'admin'], function () {
        Route::get('/dashboard', [PelangganController::class, 'dashboard_admin'])->name('dashboard.admin');
        Route::get('/pelanggan', [PelangganController::class, 'pelanggan'])->name('pelanggan.index');
        Route::get('/pelanggan/{id}', [PelangganController::class, 'hapus_pelanggan']);
        Route::post('/pelanggan/{id}', [PelangganController::class, 'edit_pelanggan']);
        Route::get('/updatestatus/{id}', [PelangganController::class, 'updateStatus'])->name('updateStatus');
        Route::resource('pengaduan',PengaduanController::class)->only('destroy','update','index','show')->names
        ([
            'index' => 'pengaduan.admin.index',
            'show' => 'pengaduan.admin.show',
            'update' => 'pengaduan.admin.update',
            'destroy' => 'pengaduan.admin.destroy',
        ]);
        Route::put('status-pengaduan/{id}',[PengaduanController::class,'update_status'])->name('update-pengaduan');
    });

    // user
    Route::group(['middleware' => ['auth', 'OnlyUser'],'prefix' => 'user'], function () {
        Route::get('/dashboard-pelanggan', [PelangganController::class, 'dashboard_pelanggan'])->name('dashboard.user');
        Route::resource('pengaduan',PengaduanController::class)->except('create','edit');
    });
    #end dashboard#
});

Route::match(['get','post'],'/botman',[BotManController::class,'handle'])->middleware('auth', 'OnlyUser');

