<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/users', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [App\Http\Controllers\Admin\UsersController::class, 'create'])->name('admin.users.create');
    Route::get('/admin/users/{id}', [App\Http\Controllers\Admin\UsersController::class, 'show'])->name('admin.users.show');
    Route::post('/admin/users', [App\Http\Controllers\Admin\UsersController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [App\Http\Controllers\Admin\UsersController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users', [App\Http\Controllers\Admin\UsersController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users', [App\Http\Controllers\Admin\UsersController::class, 'destroy'])->name('admin.users.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// useless routes
// Just to demo sidebar dropdown links active states.
Route::get('/buttons/text', function () {
    return view('buttons-showcase.text');
})->middleware(['auth'])->name('buttons.text');

Route::get('/buttons/icon', function () {
    return view('buttons-showcase.icon');
})->middleware(['auth'])->name('buttons.icon');

Route::get('/buttons/text-icon', function () {
    return view('buttons-showcase.text-icon');
})->middleware(['auth'])->name('buttons.text-icon');

require __DIR__ . '/auth.php';
