<?php

use Illuminate\Support\Facades\Route;
use Smartwebsource\RequestLogger\Http\Controllers\RequestLogController;

Route::middleware(['web', 'auth'])->prefix('request-logs')->group(function () {
    Route::get('/', [RequestLogController::class, 'index'])->name('request_logs.index');
    Route::post('/truncate', [RequestLogController::class, 'truncate'])->name('request_logs.truncate');
});
