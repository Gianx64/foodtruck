<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\FoodtruckController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('profile/user', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::get('users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
    Route::get('events', [EventController::class, 'index'])->name('events.index');
    Route::get('applications', [FoodtruckController::class, 'index'])->name('applications.index');
    Route::get('documents', [FoodtruckController::class, 'documentsIndex'])->name('documents.index');
    Route::get('names', [FoodtruckController::class, 'namesIndex'])->name('names.index');
});

Route::get('events/{event}', [EventController::class, 'show'])->name('events.show');