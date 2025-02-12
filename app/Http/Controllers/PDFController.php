<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Bidder;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;

class PDFController extends Controller {
    public function viewPDF($id) {
        $report = Report::with('bidders')->findOrFail($id);
        $html = View::make('pdf.pdf_layout', compact('report'))->render();
        return response()->stream(function() use ($html) {
            echo Browsershot::html($html)
            ->timeout(30) 
            ->format('A4')
            ->margins(0, 2, 0, 2)
            ->setOption('height', null) // Set height to null for dynamic height
            ->pdf();
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "inline; filename=\"report-$id.pdf\""
        ]);
    }

    public function downloadPDF($id) {
        $report = Report::with('bidders')->findOrFail($id);
        $html = View::make('pdf.pdf_layout', compact('report'))->render();
    
        $pdfPath = storage_path("app/public/report-$id.pdf");
    
        Browsershot::html($html)
            ->timeout(60) 
            ->format('A4')
            ->margins(0, 2, 0, 2)
            ->setOption('height', null) // Set height to null for dynamic height
            ->save($pdfPath);
    
        return response()->download($pdfPath);
    }
    }
