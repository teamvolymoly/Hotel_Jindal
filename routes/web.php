<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuCategoryController;
use App\Http\Controllers\Admin\ContactInquiryController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\MenuOrderController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/blogs/{blog:slug}', [HomeController::class, 'showBlog'])->name('blogs.show');

Route::view('/about', 'pages.about')->name('about');
Route::view('/rooms', 'pages.rooms')->name('rooms');
Route::view('/eat-drink', 'pages.eatdrink')->name('eatdrink');
Route::view('/experiences', 'pages.experiences')->name('experiences');
Route::view('/gallery', 'pages.gallery')->name('gallery');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/menu', 'pages.menu')->name('menu');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'create'])->name('login');
        Route::post('/login', [AuthController::class, 'store'])->name('login.store');
    });

    Route::middleware('admin')->group(function () {
        Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
        Route::get('/dashboard', DashboardController::class)->name('dashboard');
        Route::resource('blogs', BlogController::class)->except(['show']);
        Route::resource('menu-categories', MenuCategoryController::class)->except(['show']);
        Route::resource('menu-items', MenuItemController::class)->except(['show']);
        Route::get('/menu-orders', [MenuOrderController::class, 'index'])->name('menu-orders.index');
        Route::get('/contact-inquiries', [ContactInquiryController::class, 'index'])->name('contact-inquiries.index');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    });
});
