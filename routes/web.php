<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PaymentController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GalleryController;






Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/gallery', 'gallery')->name('gallery');
    Route::get('/check/login', 'check_login')->name('check_login');
});



Route::middleware('auth')->group(function () {
    Route::post('/update-profile', [AccountController::class, 'updateProfile']);
    Route::post('/change-password', [AccountController::class, 'changePassword']);
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [BookingController::class, 'dashboard'])->name('dashboard');
    Route::get('/payment', [BookingController::class, 'payment'])->name('payment');
    Route::get('/user/profile', [BookingController::class, 'user_profile'])->name('user.profile');
    
    // Booking Routes
    Route::prefix('bookings')->group(function () {
        Route::post('/', [BookingController::class, 'store'])->name('bookings.store');
        Route::post('/{id}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
        Route::post('/{id}/reschedule', [BookingController::class, 'reschedule'])->name('bookings.reschedule');
    });
});

Route::get('/booking/paypal/success', [BookingController::class, 'paypalSuccess'])
    ->name('booking.paypal.success')
    ->middleware('auth');

Route::get('/booking/paypal/cancel', [BookingController::class, 'paypalFailed'])
    ->name('booking.paypal.cancel')
    ->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('appointments', AppointmentController::class);
// No {id} in the URL, we’ll send it in the request body
Route::post('/admin/appointments/update-status', [AppointmentController::class, 'updateStatus'])
    ->name('appointments.update-status');

    Route::resource('services', ServiceController::class);
        Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');
        Route::resource('users', UserController::class);
        Route::resource('testimonials', TestimonialController::class);

        Route::get('/profile', [DashboardController::class, 'admin_profile'])->name('profile');
        Route::get('/gallery', [DashboardController::class, 'admin_gallery'])->name('gallery');

        Route::post('gallery/update', [GalleryController::class, 'update'])
        ->name('gallery.update');

});

require __DIR__.'/auth.php';
