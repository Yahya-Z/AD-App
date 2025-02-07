<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

Route::view('/', 'home');

Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create');

Route::post('/reports/store', [ReportController::class, 'store'])->name('reports.store');

Route::get('/reports/{contract}', [ReportController::class, 'show'])->name('reports.show');

Route::get('/reports/{id}/pdf', [ReportController::class, 'generatePdf'])->name('reports.pdf');
Route::get('/reports/{id}/download', [ReportController::class, 'downloadPdf'])->name('reports.download');

Route::delete('/reports/{id}', [ReportController::class, 'destroy'])->name('reports.destroy');