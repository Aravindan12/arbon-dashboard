<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebNotificationController;

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

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginUser'])->name('login.user');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerUser'])->name('login.register');
Route::get('/dashboard', function () {
    return view('welcome');
})->middleware('auth');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/admin', [AuthController::class,'showAdminLoginForm'])->name('admin.login-view');
Route::post('/admin', [AuthController::class,'adminLogin'])->name('admin.login');

Route::get('/admin/dashboard', function () {
    return view('admin');
})->middleware('auth:admin');
Route::get('/push-notificaiton', [WebNotificationController::class, 'index'])->name('push-notificaiton');
Route::post('/store-token', [WebNotificationController::class, 'storeToken'])->name('store.token');
Route::post('/send-web-notification', [WebNotificationController::class, 'sendWebNotification'])
->name('send.web-notification');

Route::namespace('admin')->prefix('admin')->name('admin.')->middleware(['auth:admin'])->group(function () {
    Route::get('/users', [UserController::class,'index'])->name('users');
    Route::get('/users_pagination', [UserController::class, 'pagination'])->name('users.pagination');
    Route::post('/users/download', [UserController::class, 'usersListDownload'])
    ->name('users.download');
    Route::get('/users/add', [UserController::class,'addUser'])->name('users.add');
    Route::post('/users/store', [UserController::class,'storeUser'])->name('users.store');

});