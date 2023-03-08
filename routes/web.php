<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetController;
use App\Http\Controllers\CMS\EmailController;
use App\Http\Controllers\CMS\GoogleController;
use App\Http\Controllers\CMS\HomeController;
use App\Http\Controllers\CMS\SearchController;
use App\Http\Controllers\ImportController;
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
Route::middleware(['adminExist','isAdmin'])->group(function(){
    Route::get('/dashboard', [HomeController::class, 'index'])->name('index');
    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
});
Route::get('/admin/login', [LoginController::class, 'index'])->name('login');
Route::post('/admin/login', [LoginController::class, 'handle'])->name('handle.login');
Route::get('/admin/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/admin/register', [RegisterController::class, 'index'])->name('register');
Route::get('/admin/edit-password', [ResetController::class, 'index'])->name('edit.password');
Route::post('/admin/edit-password', [ResetController::class, 'reset'])->name('update.password');
Route::get('/detail-post/{id}', [HomeController::class, 'detail'])->name('detail');
Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::get('admin/login-google/{provider}',[GoogleController::class,'redirect'])->name('LoginGoogle');
Route::get('/callback/{provider}',[GoogleController::class,'callback'])->name('Callback');

Route::get('/log',[HomeController::class,'log'])->name('log');

Route::get('/email',[EmailController::class,'index'])->name('mail');
Route::post('/sendmail',[EmailController::class,'sendmail'])->name('sendmail');
Route::post('/upload-file-post',[ImportController::class,'uploadFilePost'])->name('upload');