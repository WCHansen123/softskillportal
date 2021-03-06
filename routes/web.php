<?php

use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

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
})->name('welcome');

Route::get('/create', [App\Http\Controllers\CharacterController::class, 'create'])->name('create');

Route::get('/overview', [App\Http\Controllers\CharacterController::class, 'index'])->name('overview');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/createbase', [App\Http\Controllers\CharacterController::class, 'store'])->name('createbase');

Route::get('/logout', [App\Http\Controllers\PageController::class, 'Logout'])->name('logout');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('groups', GroupController::class);

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::get('/students/createlist', [App\Http\Controllers\UserController::class, 'CreateList'])->name('createList');
    Route::post('/students/storelist', [App\Http\Controllers\UserController::class, 'StoreList'])->name('storeList');
});