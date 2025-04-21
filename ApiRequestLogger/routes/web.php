<?php

use Illuminate\Support\Facades\Route;
use Smartwebsource\ApiRequestLogger\Http\Controllers\ApiRequestLogController;

Route::middleware(['web', 'auth'])->prefix('api-request-logs')->group(function () {
    Route::get('/', [ApiRequestLogController::class, 'index'])->name('api_request_logs.index');
    Route::post('/truncate', [ApiRequestLogController::class, 'truncate'])->name('api_request_logs.truncate');
});
