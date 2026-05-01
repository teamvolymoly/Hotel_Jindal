<?php

use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\BlogController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\MenuCategoryController;
use App\Http\Controllers\Api\Admin\ContactInquiryController as AdminContactInquiryController;
use App\Http\Controllers\Api\Admin\MenuItemController;
use App\Http\Controllers\Api\Admin\MenuOrderController as AdminMenuOrderController;
use App\Http\Controllers\Api\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Api\ContactInquiryController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\MenuOrderController;
use Illuminate\Support\Facades\Route;

Route::get('/menu', MenuController::class)->name('api.menu');
Route::post('/menu/orders', [MenuOrderController::class, 'store'])->name('api.menu.orders.store');
Route::post('/contact-inquiries', [ContactInquiryController::class, 'store'])->name('api.contact-inquiries.store');

Route::prefix('admin')->name('api.admin.')->group(function () {
    Route::post('/login', [AuthController::class, 'store'])->name('login');

    Route::middleware(['web', 'admin.api'])->group(function () {
        Route::get('/me', [AuthController::class, 'me'])->name('me');
        Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
        Route::get('/dashboard', DashboardController::class)->name('dashboard');
        Route::get('/profile', [AdminProfileController::class, 'show'])->name('profile.show');
        Route::patch('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
        Route::patch('/profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.update-password');

        Route::get('/menu-categories/parent-options', [MenuCategoryController::class, 'parentOptions'])->name('menu-categories.parent-options');
        Route::apiResource('blogs', BlogController::class);
        Route::apiResource('menu-categories', MenuCategoryController::class);

        Route::get('/menu-items/category-options', [MenuItemController::class, 'categoryOptions'])->name('menu-items.category-options');
        Route::apiResource('menu-items', MenuItemController::class);
        Route::get('/menu-orders/latest', [AdminMenuOrderController::class, 'latest'])->name('menu-orders.latest');
        Route::get('/menu-orders', [AdminMenuOrderController::class, 'index'])->name('menu-orders.index');
        Route::get('/menu-orders/{menuOrder}', [AdminMenuOrderController::class, 'show'])->name('menu-orders.show');
        Route::patch('/menu-orders/{menuOrder}/status', [AdminMenuOrderController::class, 'updateStatus'])->name('menu-orders.update-status');
        Route::get('/contact-inquiries', [AdminContactInquiryController::class, 'index'])->name('contact-inquiries.index');
        Route::get('/contact-inquiries/{contactInquiry}', [AdminContactInquiryController::class, 'show'])->name('contact-inquiries.show');
    });
});
