<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MenuCategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PaymentController;

use App\Http\Controllers\Web\WebController;
use App\Http\Controllers\Web\AuthController;

use App\Http\Controllers\Guest\BookController;
use App\Http\Controllers\Guest\GuestController;


// Routes for web landing
Route::get('/', [WebController::class, 'index'])->name('web.home');

// Routes for authentication
Route::get('/login', [AuthController::class, 'index'])->name('auth.login');
Route::post('/login', [AuthController::class, 'doLogin'])->name('auth.dologin');
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'doRegister'])->name('auth.doregister');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Routes for admin dashboard
Route::get('/home', [HomeController::class, 'index'])->name('admin.home');

Route::get('/menu-category', [MenuCategoryController::class, 'index'])->name('admin.menu.category');

Route::get('/menu', [MenuController::class, 'index'])->name('admin.menu');
Route::get('/menu/new', [MenuController::class, 'create'])->name('admin.menu.new');
Route::post('/menu/new', [MenuController::class, 'store'])->name('admin.menu.store');
Route::get('/menu/show/{id}', [MenuController::class, 'show'])->name('admin.menu.show');
Route::get('/menu/edit/{id}', [MenuController::class, 'edit'])->name('admin.menu.edit');
Route::put('/menu/update', [MenuController::class, 'update'])->name('admin.menu.update');
Route::delete('/menu/delete/{id}', [MenuController::class, 'delete'])->name('admin.menu.delete');

Route::get('/guest', [UserController::class, 'getAllGuest'])->name('admin.guest');

Route::get('/order', [OrderController::class, 'index'])->name('admin.order');
Route::delete('/order', [OrderController::class, 'deleteById'])->name('admin.order-delete-by-id');
Route::get('/order/status/processed/{id}', [OrderController::class, 'statusChangeToProcessed'])->name('admin.order-status-processed');
Route::get('/order/status/done/{id}', [OrderController::class, 'statusChangeToDone'])->name('admin.order-status-change-to-done');
Route::get('/order/status/cancel/{id}', [OrderController::class, 'statusChangeToCancel'])->name('admin.order-status-change-to-cancel');

Route::get('/payments', [PaymentController::class, 'index'])->name('admin.payments');
Route::get('/transactions', [TransactionController::class, 'index'])->name('admin.transactions');
Route::delete('/transactions', [TransactionController::class, 'deleteById'])->name('admin.transactions.delete');


// Routes for guest dashboard
Route::get('/guest/home', [GuestController::class, 'index'])->name('guest.home');
Route::post('/guest/profile-update', [GuestController::class, 'profileUpdate'])->name('guest.profile-update');
Route::post('/guest/pass-update', [GuestController::class, 'passUpdate'])->name('guest.pass-update');

Route::get('/book/new/{id}', [BookController::class, 'newBook'])->name('guest.book.new');
Route::post('/book/new', [BookController::class, 'bookStore'])->name('guest.book.store');
Route::put('/book/canceled/{id}', [BookController::class, 'canceled'])->name('guest.book.canceled');
