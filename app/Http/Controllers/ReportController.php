<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports/index', [
            'reports' => Report::all()
        ]);
    }

    public function create()
    {
        $reports = Report::all();
        return view('reports.create', compact('reports'));    
    }

    public function addBidder()
    {
        $reports = Report::all();
        return view('reports.addBidder', compact('reports'));
    }

    // app/Http/Controllers/ReportController.php
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'report_id' => 'required|exists:reports,id',
            'offer_number' => 'required|string|max:255',
            'project' => 'required|string|max:255',
            'item' => 'required|string|max:255',
            'committees_members' => 'required|string|max:255',
            'committees_chairman' => 'required|string|max:255',
            'bidders.*.name' => 'required|string|max:255',
            'bidders.*.currency' => 'required|string|max:255',
            'bidders.*.amount' => 'required|numeric',
            'bidders.*.discount' => 'nullable|numeric',
            'bidders.*.commercial_register' => 'nullable|string|max:255',
            'bidders.*.tax_card' => 'nullable|string|max:255',
            'bidders.*.zakat_card' => 'nullable|string|max:255',
            'bidders.*.shop_license' => 'nullable|string|max:255',
            'bidders.*.notes' => 'nullable|string',
        ]);
    
        // Check if a report with the same offer_number and project exists
        $report = Report::where('offer_number', $validated['offer_number'])
            ->where('project', $validated['project'])
            ->first();
    
        // Create the report if it doesn't exist
        if (!$report) {
            $report = Report::create([
                'offer_number' => $validated['offer_number'],
                'project' => $validated['project'],
                'item' => $validated['item'],
                'committees_members' => $validated['committees_members'],
                'committees_chairman' => $validated['committees_chairman'],
            ]);
        }
    
        // Create bidders
        if ($request->has('bidders')) {
            foreach ($request->bidders as $bidderData) {
                $report->bidders()->create([
                    'name' => $bidderData['name'],
                    'currency' => $bidderData['currency'],
                    'amount' => $bidderData['amount'],
                    'discount' => $bidderData['discount'] ?? 0,
                    'final_amount' => $bidderData['amount'] - ($bidderData['discount'] ?? 0),
                    'commercial_register' => isset($bidderData['commercial_register']),
                    'tax_card' => isset($bidderData['tax_card']),
                    'zakat_card' => isset($bidderData['zakat_card']),
                    'shop_license' => isset($bidderData['shop_license']),
                    'notes' => $bidderData['notes'] ?? '',
                ]);
            }
        }
    
        return redirect()->route('reports.index')->with('success', 'تم إضافة البيانات بنجاح');
    }

    public function storeBidder(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'report_id' => 'required|exists:reports,id',
            'name' => 'required|string|max:255',
            'currency' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'commercial_register' => 'nullable|string|max:255',
            'tax_card' => 'nullable|string|max:255',
            'zakat_card' => 'nullable|string|max:255',
            'shop_license' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Find the report
        $report = Report::findOrFail($validated['report_id']);

        // Create the bidder
        $report->bidders()->create($validated);

        return redirect()->route('reports.index')->with('success', 'Bidder added successfully.');
    }

    public function show(Report $report)
    {
        return view('reports/show', compact('report'));
    }

    public function generate(Request $request)
    {
        // Log the request data
        \Log::info('Generate PDF Request:', $request->all());
    
        if (!$request->has('report_ids')) {
            return redirect()->back()->with('error', 'No reports selected.');
        }
    
        $selectedReports = Report::whereIn('id', $request->report_ids)->with('bidders')->get();
    
        // Check if reports are fetched
        if ($selectedReports->isEmpty()) {
            return redirect()->back()->with('error', 'No reports selected.');
        }
    
        $pdf = PDF::loadView('pdf.pdf_layout', compact('selectedReports'))
                  ->setOption('defaultFont', 'IBMPlexSansArabic')
                  ->setOption('isRemoteEnabled', true)
                  ->setOption('isHtml5ParserEnabled', true)
                  ->setOption('direction', 'rtl');
    
        return $pdf->stream('reports.pdf');
    }

    public function download(Request $request)
    {
        // Log the request data
        \Log::info('Generate PDF Request:', $request->all());

        if (!$request->has('report_ids')) {
            return redirect()->back()->with('error', 'No reports selected.');
        }

        $selectedReports = Report::whereIn('id', $request->report_ids)->with('bidders')->get();

        // Check if reports are fetched
        if ($selectedReports->isEmpty()) {
            return redirect()->back()->with('error', 'No reports selected.');
        }
    
        $pdf = PDF::loadView('pdf.pdf_layout', compact('selectedReports'))
                  ->setOption('defaultFont', 'IBMPlexSansArabic')
                  ->setOption('isRemoteEnabled', true)
                  ->setOption('isHtml5ParserEnabled', true)
                  ->setOption('direction', 'rtl');
    
        return $pdf->download('reports.pdf');
    }
    
    public function destroy($id)
    {
        try {
            // Find the contract by ID and delete it
            $report  = Report::findOrFail($id);
            $report ->delete();

            // Redirect back with a success message
            return redirect()->route('reports.index')->with('success', 'Report deleted successfully.');
        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->route('reports.index')->with('error', 'Failed to delete the bid.');
        }
    }

}
