<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\Auth\RegisteredBusinessController;
use App\Http\Controllers\Auth\BusinessAuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');


// route for business
Route::get('/business/register', [RegisteredBusinessController::class, 'create'])
                ->middleware('guest')
                ->name('business.register');

Route::post('/business/register', [RegisteredBusinessController::class, 'store'])
                ->middleware('guest');

Route::get('/business/login', [BusinessAuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('business.login');

Route::post('/business/login', [BusinessAuthenticatedSessionController::class, 'store'])
                ->middleware('guest');

Route::post('/business/logout', [BusinessAuthenticatedSessionController::class, 'destroy'])
                ->middleware('business.auth:business')
                ->name('business.logout');


// route for health staff
Route::get('/healthstaff/register', [RegisteredUserController::class, 'create_healthstaff'])
                ->middleware('guest')
                ->name('healthstaff.register');

Route::post('/healthstaff/register', [RegisteredUserController::class, 'store_user_healthstaff'])
                ->middleware('guest');

Route::get('/healthstaff/login', [AuthenticatedSessionController::class, 'create_healthstaff'])
                ->middleware('guest')
                ->name('healthstaff.login');

Route::post('/healthstaff/login', [AuthenticatedSessionController::class, 'store_healthstaff'])
                ->middleware('guest');
