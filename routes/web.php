<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
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

//Route::view('', 'home')->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('profile/user', [UserController::class, 'editSelf'])->name('users.editSelf');
    Route::put('profile/user', [UserController::class, 'updateSelf'])->name('users.updateSelf');
    Route::get('users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
    Route::get('users/assign/{user}', [UserController::class, 'assign'])->name('users.assign');
    Route::put('users/assign/{user}', [UserController::class, 'updateRole']);

    Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::get('roles/edit/{role}', [RoleController::class, 'edit'])->name('roles.edit');

    Route::apiResource('users', UserController::class); //->except('show')
    Route::apiResource('roles', RoleController::class);
});