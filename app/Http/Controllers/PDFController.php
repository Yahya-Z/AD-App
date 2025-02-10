<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;

class PDFController extends Controller {
    public function viewPDF($id) {
        $report = Report::with('bidders')->findOrFail($id);
        return view('pdf.report', compact('report'));
    }

    public function downloadPDF($id) {
        $report = Report::with('bidders')->findOrFail($id);
        $html = View::make('pdf.report', compact('report'))->render();

        $pdfPath = storage_path("app/public/report-$id.pdf");

        Browsershot::html($html)
            ->format('A4')
            ->margins(10, 10, 10, 10)
            ->save($pdfPath);

        return Response::download($pdfPath);
    }
}
