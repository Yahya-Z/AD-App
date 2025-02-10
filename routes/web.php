<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BidderController;

Route::view('/', 'home');

Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create');

Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
Route::get('/reports/{id}', [ReportController::class, 'show'])->name('reports.show');

// Route::get('/reports/add-bidder', [ReportController::class, 'addBidder'])->name('bidders.create');
// Route::post('/bidders', [ReportController::class, 'storeBidder'])->name('bidders.store');

Route::get('/reports/{id}/pdf', [PDFController::class, 'viewPDF'])->name('pdf.view');
Route::get('/reports/{id}/pdf/download', [PDFController::class, 'downloadPDF'])->name('pdf.download');

Route::post('/reports/{report_id}/bidders', [BidderController::class, 'store'])->name('bidders.store');

Route::delete('/reports/{id}', [ReportController::class, 'destroy'])->name('reports.destroy');

// routes/web.php
Route::get('/test-pdf', function () {
    $report = Report::first(); // Test with one report
    $pdf = PDF::loadView('pdf.pdf_layout', ['selectedReports' => [$report]]);
    return $pdf->stream('test.pdf');
});