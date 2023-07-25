<?php

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
    Route::get('profile/user', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::get('users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
    Route::get('events', [App\Http\Controllers\EventController::class, 'index'])->name('events.index');
    Route::get('applications', [App\Http\Controllers\FoodtruckController::class, 'index'])->name('applications.index');
    Route::get('documents', [App\Http\Controllers\FoodtruckController::class, 'documentsIndex'])->name('documents.index');
    Route::get('names', [App\Http\Controllers\FoodtruckController::class, 'namesIndex'])->name('names.index');
});

Route::get('events/{event}', [App\Http\Controllers\EventController::class, 'show'])->name('events.show');