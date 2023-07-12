<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\FoodtruckController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('profile/user', [UserController::class, 'edit'])->name('users.edit');
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('events', [EventController::class, 'index'])->name('events.index');
    Route::get('foodtrucks', [FoodtruckController::class, 'index'])->name('foodtrucks.index');
    Route::get('foodtypes', [FoodtruckController::class, 'foodIndex'])->name('foodtypes.index');

    /*Route::apiResource('users', UserController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('events', EventController::class)->except('show');
    Route::apiResource('foodtrucks', FoodtruckController::class);*/
});

Route::get('events/{event}', [EventController::class, 'show'])->name('events.show');