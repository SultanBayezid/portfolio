<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\HireBannerController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\VisibilityController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\VerificationController;

/*
|--------------------------------------------------------------------------
| Public Portfolio Homepage
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Public contact form submission (no auth required)
Route::post('contact/post', [ContactController::class, 'post'])->name('contact.post');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);

    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
    Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm']);

    Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/verification-notification', [VerificationController::class, 'resend'])->name('verification.resend');
});

/*
|--------------------------------------------------------------------------
| Admin Panel Routes (auth + admin middleware)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Hero Section
    Route::put('hero', [HeroController::class, 'update'])->name('hero.update');

    // About Section
    Route::put('about', [AboutController::class, 'update'])->name('about.update');

    // Projects
    Route::post('projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::put('projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    // Skills
    Route::put('skills', [SkillController::class, 'update'])->name('skills.update');

    // Services
    Route::put('services', [ServiceController::class, 'update'])->name('services.update');

    // Hire Banner
    Route::put('hirebanner', [HireBannerController::class, 'update'])->name('hirebanner.update');

    // Filter Categories
    Route::put('filters', [SettingsController::class, 'updateFilters'])->name('filters.update');

    // Testimonials
    Route::put('testimonials', [TestimonialController::class, 'update'])->name('testimonials.update');

    // Contact Section Settings
    Route::put('contact', [ContactController::class, 'update'])->name('contact.update');

    // Messages
    Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('messages/{message}/read', [MessageController::class, 'markRead'])->name('messages.markRead');
    Route::post('messages/mark-all-read', [MessageController::class, 'markAllRead'])->name('messages.markAllRead');
    Route::delete('messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
    Route::delete('messages/clear-read', [MessageController::class, 'clearRead'])->name('messages.clearRead');

    // SEO
    Route::put('seo', [SeoController::class, 'update'])->name('seo.update');

    // Visibility
    Route::put('visibility', [VisibilityController::class, 'update'])->name('visibility.update');

    // Settings
    Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::put('theme', [SettingsController::class, 'updateTheme'])->name('theme.update');
    Route::put('password', [SettingsController::class, 'updatePassword'])->name('password.update');
    Route::post('export/json', [SettingsController::class, 'exportJson'])->name('export.json');
    Route::post('backup', [SettingsController::class, 'createBackup'])->name('backup.create');
    Route::post('cache-clear', [SettingsController::class, 'clearCache'])->name('cache.clear');
    Route::delete('settings/reset', [SettingsController::class, 'resetDefaults'])->name('settings.reset');
});
