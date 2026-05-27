<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VideoProjectController;
use App\Http\Controllers\VideoProjectPreviewController;
use App\Http\Controllers\VideoProjectStatusController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function (): void {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function (): void {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/video-projects/create', [VideoProjectController::class, 'create'])->name('video-projects.create');
    Route::post('/video-projects', [VideoProjectController::class, 'store'])->name('video-projects.store');

    Route::get('/video-projects/{videoProject}', [VideoProjectController::class, 'show'])
        ->can('view', 'videoProject')
        ->name('video-projects.show');

    Route::get('/video-projects/{videoProject}/status', VideoProjectStatusController::class)
        ->can('view', 'videoProject')
        ->name('video-projects.status');

    Route::get('/video-projects/{videoProject}/preview', [VideoProjectPreviewController::class, 'show'])
        ->can('view', 'videoProject')
        ->name('video-projects.preview');

    Route::get('/video-projects/{videoProject}/stream', [VideoProjectPreviewController::class, 'stream'])
        ->can('view', 'videoProject')
        ->name('video-projects.stream');

    Route::get('/video-projects/{videoProject}/download', [VideoProjectPreviewController::class, 'download'])
        ->can('view', 'videoProject')
        ->name('video-projects.download');

    Route::get('/admin', AdminDashboardController::class)
        ->can('access-admin')
        ->name('admin.dashboard');
});
