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

Route::get('foodtrucks/create/{event}', [FoodtruckController::class, 'create'])->name('foodtrucks.create');
Route::post('foodtrucks/create', [FoodtruckController::class, 'store'])->name('foodtrucks.store');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('profile/user', [UserController::class, 'edit'])->name('users.edit');
    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('roles/edit/{role}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index');

    Route::get('events', [EventController::class, 'index'])->name('events.index');
    
    Route::get('foodtrucks/edit/{foodtruck}', [FoodtruckController::class, 'edit'])->name('foodtrucks.edit');
    Route::get('foodtrucks/accept/{foodtruck}', [FoodtruckController::class, 'accept'])->name('foodtrucks.accept');
    Route::get('foodtrucks', [FoodtruckController::class, 'index'])->name('foodtrucks.index');

    Route::apiResource('users', UserController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('events', EventController::class)->except('show');
    Route::apiResource('foodtrucks', FoodtruckController::class);
});

Route::get('events/{event}', [EventController::class, 'show'])->name('events.show');