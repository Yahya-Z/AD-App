<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Models\Report;

Route::view('/', 'home');

Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create');

Route::post('/reports/store', [ReportController::class, 'store'])->name('reports.store');

Route::get('/reports/{report}', [ReportController::class, 'show'])->name('reports.show');

Route::post('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
Route::post('/reports/download', [ReportController::class, 'download'])->name('reports.download');

Route::delete('/reports/{id}', [ReportController::class, 'destroy'])->name('reports.destroy');

// routes/web.php
Route::get('/test-pdf', function () {
    $report = Report::first(); // Test with one report
    $pdf = PDF::loadView('pdf.pdf_layout', ['selectedReports' => [$report]]);
    return $pdf->stream('test.pdf');
});