<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\UserController;
use App\Models\Kegiatan;
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

Route::group(['middleware' => ['check.login']], function () {
    Route::get('/login', [UserController::class, 'login'])->name('login');
});

Route::group(['middleware' => ['check.ajax']], function () {
    Route::post('/login', [UserController::class, 'login_user'])->name('user.login');
});

Route::group(['middleware' => ['check.session']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
    Route::get('/kegiatan/create', [KegiatanController::class, 'create'])->name('kegiatan.create');
    Route::get('/kegiatan/edit/{id}', [KegiatanController::class, 'edit']);
    Route::get('/kegiatan/detail/{id}', [KegiatanController::class, 'detail']);
    Route::delete('/kegiatan/foto/delete/{id}/{idp}', [KegiatanController::class, 'delete_foto'])->name('kegiatan.foto.delete');
    Route::get('/kegiatan/pdf/{id}', [KegiatanController::class, 'pdf'])->name('kegiatan.pdf');
});

Route::group(['middleware' => ['check.session', 'check.ajax']], function () {
    Route::post('/user/data', [UserController::class, 'data'])->name('user.data');
    Route::post('/user/save', [UserController::class, 'save'])->name('user.save');
    Route::post('/user/delete', [UserController::class, 'delete'])->name('user.delete');
    Route::post('/kegiatan/data', [KegiatanController::class, 'data'])->name('kegiatan.data');
    Route::post('/kegiatan/save', [KegiatanController::class, 'save'])->name('kegiatan.save');
    Route::post('/kegiatan/delete/{id}', [KegiatanController::class, 'delete'])->name('kegiatan.delete');
});

Route::get('/logout', [UserController::class, 'logout_user'])->name('user.logout');
