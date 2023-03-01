<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CMS\PostController;
use App\Http\Controllers\CMS\TagController;
use App\Http\Controllers\CMS\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/admin/get-user', [UserController::class, 'getAllUser'])->name('getAllUser');
Route::post('/admin/delete-user', [UserController::class, 'delete'])->name('delete.User');
Route::get('/admin/show-user/{id}', [UserController::class, 'show'])->name('show.user');
Route::post('/admin/update-password', [UserController::class, 'updatePass'])->name('update.password');
Route::post('/admin/forgot-password', [UserController::class, 'forgotPass'])->name('forgot.password');
//Post
Route::get('/admin/get-post', [PostController::class, 'getAllPost'])->name('getAllPost');
Route::post('/admin/create-post', [PostController::class, 'store'])->name('create_store');
Route::post('/admin/update-post/{id}', [PostController::class, 'update'])->name('update.post');
Route::post('/admin/delete-post/{id}', [PostController::class, 'delete'])->name('delete.post');
Route::post('/admin/login', [LoginController::class, 'handle'])->name('handle.login');
Route::post('/admin/register', [RegisterController::class, 'store'])->name('handle.register');
//Tag
Route::get('/admin/get-tag', [TagController::class, 'getAllTag'])->name('getAllTag');
Route::post('/admin/create-tag', [TagController::class, 'store'])->name('create_tag');
Route::post('/admin/update-tag/{id}', [TagController::class, 'update'])->name('update.tag');
Route::post('/admin/delete-tag/{id}', [TagController::class, 'delete'])->name('delete.tag');
