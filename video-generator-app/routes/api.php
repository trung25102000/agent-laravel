<?php

use App\Http\Controllers\Api\VideoProjectController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'throttle:api'])->group(function (): void {
    Route::post('/video-projects', [VideoProjectController::class, 'store']);
    Route::get('/video-projects/{videoProject}/status', [VideoProjectController::class, 'status'])
        ->can('view', 'videoProject');
    Route::get('/video-projects/{videoProject}/result', [VideoProjectController::class, 'result'])
        ->can('view', 'videoProject');
});
