<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\UserController;
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

Route::get('/', [HomeController::class, 'index'])->name('dashboard');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'login_user'])->name('user.login');
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::post('/user/data', [UserController::class, 'data'])->name('user.data');
Route::post('/user/save', [UserController::class, 'save'])->name('user.save');
Route::post('/user/delete', [UserController::class, 'delete'])->name('user.delete');
Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
Route::get('/kegiatan/create', [KegiatanController::class, 'create'])->name('kegiatan.create');
Route::post('/kegiatan/data', [KegiatanController::class, 'data'])->name('kegiatan.data');
Route::post('/kegiatan/save', [KegiatanController::class, 'save'])->name('kegiatan.save');
