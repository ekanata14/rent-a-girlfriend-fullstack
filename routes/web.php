<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\UserPackageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Client\DashboardController as ClientDashboardController;

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
Route::middleware(['checkAuth', 'IsAdmin'])->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Users
    Route::get('/admin/users', [UsersController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [UsersController::class, 'create'])->name('admin.users.create');
    Route::get('/admin/users/{id}', [UsersController::class, 'show'])->name('admin.users.show');
    Route::post('/admin/users', [UsersController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [UsersController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users', [UsersController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users', [UsersController::class, 'destroy'])->name('admin.users.destroy');

    // Users Packages
    Route::get('/admin/user-packages', [UserPackageController::class, 'index'])->name('admin.user-packages.index');
    Route::get('/admin/user-packages/create', [UserPackageController::class, 'create'])->name('admin.user-packages.create');
    Route::get('/admin/user-packages/{id}', [UserPackageController::class, 'show'])->name('admin.user-packages.show');
    Route::post('/admin/user-packages', [UserPackageController::class, 'store'])->name('admin.user-packages.store');
    Route::get('/admin/user-packages/{id}/edit', [UserPackageController::class, 'edit'])->name('admin.user-packages.edit');
    Route::put('/admin/user-packages', [UserPackageController::class, 'update'])->name('admin.user-packages.update');
    Route::delete('/admin/user-packages', [UserPackageController::class, 'destroy'])->name('admin.user-packages.destroy');

    // Orders
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/admin/orders/create', [OrderController::class, 'create'])->name('admin.orders.create');
    Route::get('/admin/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/admin/orders', [OrderController::class, 'store'])->name('admin.orders.store');
    Route::get('/admin/orders/{id}/edit', [OrderController::class, 'edit'])->name('admin.orders.edit');
    Route::put('/admin/orders', [OrderController::class, 'update'])->name('admin.orders.update');
    Route::delete('/admin/orders', [OrderController::class, 'destroy'])->name('admin.orders.destroy');

    // Messages
    Route::get('/admin/messages', [MessageController::class, 'index'])->name('admin.messages.index');
    Route::get('/admin/messages/create', [MessageController::class, 'create'])->name('admin.messages.create');
    Route::get('/admin/messages/{id}', [MessageController::class, 'show'])->name('admin.messages.show');
    Route::post('/admin/messages', [MessageController::class, 'store'])->name('admin.messages.store');
    Route::get('/admin/messages/{id}/edit', [MessageController::class, 'edit'])->name('admin.messages.edit');
    Route::put('/admin/messages', [MessageController::class, 'update'])->name('admin.messages.update');
    Route::delete('/admin/messages', [MessageController::class, 'destroy'])->name('admin.messages.destroy');

    // Rating
    Route::get('/admin/ratings', [RatingController::class, 'index'])->name('admin.ratings.index');
    Route::get('/admin/ratings/create', [RatingController::class, 'create'])->name('admin.ratings.create');
    Route::get('/admin/ratings/{id}', [RatingController::class, 'show'])->name('admin.ratings.show');
    Route::post('/admin/ratings', [RatingController::class, 'store'])->name('admin.ratings.store');
    Route::get('/admin/ratings/{id}/edit', [RatingController::class, 'edit'])->name('admin.ratings.edit');
    Route::put('/admin/ratings', [RatingController::class, 'update'])->name('admin.ratings.update');
    Route::delete('/admin/ratings', [RatingController::class, 'destroy'])->name('admin.ratings.destroy');
});

Route::middleware(['checkAuth', 'IsClient'])->group(function () {
    // Dashboard
    Route::get('/client/dashboard', [ClientDashboardController::class, 'index'])->name('client.dashboard');
    Route::post('/client/dashboard/search', [ClientDashboardController::class, 'search'])->name('admin.dashboard.search');

    // Users
    Route::get('/client/users/{id}', [UsersController::class, 'show'])->name('client.users.show');

    // Orders
    Route::get('/client/orders', [OrderController::class, 'index'])->name('client.orders.index');
    Route::get('/client/orders/incoming', [OrderController::class, 'incoming'])->name('incoming.client.orders');
    Route::get('/client/orders/create/{packageId}', [OrderController::class, 'create'])->name('client.orders.create');
    Route::get('/client/orders/{id}', [OrderController::class, 'show'])->name('client.orders.show');
    Route::post('/client/orders', [OrderController::class, 'store'])->name('client.orders.store');
    Route::get('/client/orders/{id}/edit', [OrderController::class, 'edit'])->name('client.orders.edit');
    Route::put('/client/orders', [OrderController::class, 'update'])->name('client.orders.update');
    Route::delete('/client/orders', [OrderController::class, 'destroy'])->name('client.orders.destroy');

    Route::post('/client/orders/accept', [OrderController::class, 'acceptOrder'])->name('client.orders.accept');
    Route::post('/client/orders/reject', [OrderController::class, 'rejectOrder'])->name('client.orders.reject');
    Route::post('/client/orders/finish', [OrderController::class, 'finishOrder'])->name('client.orders.finish');

    // Messages
    Route::get('/client/messages', [MessageController::class, 'index'])->name('client.messages.index');
    Route::get('/client/messages/create', [MessageController::class, 'create'])->name('client.messages.create');
    Route::get('/client/messages/{id}', [MessageController::class, 'show'])->name('client.messages.show');
    Route::post('/client/messages', [MessageController::class, 'store'])->name('client.messages.store');
    Route::get('/client/messages/{id}/edit', [MessageController::class, 'edit'])->name('client.messages.edit');
    Route::put('/client/messages', [MessageController::class, 'update'])->name('client.messages.update');
    Route::delete('/client/messages', [MessageController::class, 'destroy'])->name('client.messages.destroy');

    // User Packages
    Route::get('/client/user-packages', [UserPackageController::class, 'index'])->name('client.user-packages.index');
    Route::get('/client/user-packages/create', [UserPackageController::class, 'create'])->name('client.user-packages.create');
    Route::get('/client/user-packages/{id}', [UserPackageController::class, 'show'])->name('client.user-packages.show');
    Route::post('/client/user-packages', [UserPackageController::class, 'store'])->name('client.user-packages.store');
    Route::get('/client/user-packages/{id}/edit', [UserPackageController::class, 'edit'])->name('client.user-packages.edit');
    Route::put('/client/user-packages', [UserPackageController::class, 'update'])->name('client.user-packages.update');
    Route::delete('/client/user-packages', [UserPackageController::class, 'destroy'])->name('client.user-packages.destroy');

    // Ratings
    Route::get('/client/ratings', [RatingController::class, 'index'])->name('client.ratings.index');
    Route::get('/client/ratings/create/{gfBfId}', [RatingController::class, 'create'])->name('client.ratings.create');
    Route::get('/client/ratings/{id}', [RatingController::class, 'show'])->name('client.ratings.show');
    Route::post('/client/ratings', [RatingController::class, 'store'])->name('client.ratings.store');
    Route::get('/client/ratings/{id}/edit', [RatingController::class, 'edit'])->name('client.ratings.edit');
    Route::put('/client/ratings', [RatingController::class, 'update'])->name('client.ratings.update');
    Route::delete('/client/ratings', [RatingController::class, 'destroy'])->name('client.ratings.destroy');
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
