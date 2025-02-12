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
Route::delete('/reports/{id}', [ReportController::class, 'destroy'])->name('reports.destroy');

// Route::get('/reports/add-bidder', [ReportController::class, 'addBidder'])->name('bidders.create');
// Route::post('/bidders', [ReportController::class, 'storeBidder'])->name('bidders.store');

Route::get('/reports/{id}/pdf', [PDFController::class, 'viewPDF'])->name('pdf.view');
Route::get('/reports/{id}/pdf/download', [PDFController::class, 'downloadPDF'])->name('pdf.download');

Route::get('/reports/{report}/bidders/create', [BidderController::class, 'create'])->name('bidders.create');
Route::post('/reports/{report}/bidders', [BidderController::class, 'store'])->name('bidders.store');
Route::get('/reports/{report}/bidders', [BidderController::class, 'index']);
Route::delete('/reports/{report}/bidders/{bidder}', [BidderController::class, 'destroy'])->name('bidders.destroy');


// routes/web.php
Route::get('/test-pdf', function () {
    $report = Report::first(); // Test with one report
    $pdf = PDF::loadView('pdf.pdf_layout', ['selectedReports' => [$report]]);
    return $pdf->stream('test.pdf');
});