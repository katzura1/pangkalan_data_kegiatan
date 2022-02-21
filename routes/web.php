<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::post('/user/data', [UserController::class, 'data'])->name('user.data');
Route::post('/user/save', [UserController::class, 'save'])->name('user.save');
Route::post('/user/delete', [UserController::class, 'delete'])->name('user.delete');