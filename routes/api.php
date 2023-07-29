<?php

use App\Http\Controllers\ApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/users/store', [ApiController::class,'storeUser'])->name('users.store');
Route::get('/users/edit/{user}', [ApiController::class, 'getUser'])->name('users.edit');
Route::get('/users', [ApiController::class,'getUsers'])->name('users.list');
Route::post('/users/update', [ApiController::class, 'update'])->name('users.update');
Route::get('/users/delete/{user}', [ApiController::class, 'destroy'])->name('users.delete');

Route::get('/heroes', [ApiController::class,'getHeroes'])->name('heroes.list');
Route::post('/heroes/store', [ApiController::class,'storeHero'])->name('users.store');
Route::get('/heroes/edit/{user}', [ApiController::class, 'getHero'])->name('users.edit');
Route::post('/heroes/update', [ApiController::class, 'updateHero'])->name('users.update');
Route::get('/heroes/delete/{user}', [ApiController::class, 'destroyHero'])->name('users.delete');

