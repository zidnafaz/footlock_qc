<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\AuditParameterController;

Route::get('/', function () {
    return redirect()->route('audits.create.simple');
});

// Route Simple (All-in-One Page)
Route::get('/audit/new', [AuditController::class, 'createSimple'])->name('audits.create.simple');
Route::post('/audit/store', [AuditController::class, 'storeSimple'])->name('audits.store.simple');

// Routes untuk Audit
Route::prefix('audits')->group(function () {
    Route::get('/', [AuditController::class, 'index'])->name('audits.index');
    Route::get('/create', [AuditController::class, 'create'])->name('audits.create');
    Route::post('/', [AuditController::class, 'store'])->name('audits.store');
    Route::get('/{id}', [AuditController::class, 'show'])->name('audits.show');

    // Routes untuk Detail Audit
    Route::get('/{id}/details/create', [AuditController::class, 'createDetails'])->name('audits.details.create');
    Route::post('/{id}/details', [AuditController::class, 'storeDetails'])->name('audits.details.store');

    // Routes untuk Summary Audit
    Route::get('/{id}/summary/create', [AuditController::class, 'createSummary'])->name('audits.summary.create');
    Route::post('/{id}/summary', [AuditController::class, 'storeSummary'])->name('audits.summary.store');

    // Route untuk Report
    Route::get('/report/all', [AuditController::class, 'report'])->name('audits.report');
});

// Routes untuk Parameter (Master Data)
Route::resource('parameters', AuditParameterController::class);

