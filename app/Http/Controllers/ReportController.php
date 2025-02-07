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
        return view('reports.create');
    }

    // app/Http/Controllers/ReportController.php
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'offer_number' => 'required|string',
            'project' => 'required|string',
            'item' => 'required|string',
            'committees_members' => 'required|string',
            'committees_chairman' => 'required|string',
            'bidders.*.name' => 'required|string',
            'bidders.*.currency' => 'required|string',
            'bidders.*.amount' => 'required|numeric',
            'bidders.*.discount' => 'nullable|numeric',
        ]);
    
        // Create the report
        $report = Report::create([
            'offer_number' => $validated['offer_number'],
            'project' => $validated['project'],
            'item' => $validated['item'],
            'committees_members' => $validated['committees_members'],
            'committees_chairman' => $validated['committees_chairman'],
        ]);
    
        // Create bidders
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
    
        return redirect()->route('reports.index');
    }
    // public function show(Contract $contract)
    // {
    //     return view('contracts/show', compact('contract'));
    // }

    public function generate(Request $request)
    {
        $selectedReports = Report::whereIn('id', $request->report_ids)
                                 ->with('bidders')
                                 ->get();
    
        $pdf = PDF::loadView('pdf/pdf_layout', compact('selectedReports'))
                ->setOption('defaultFont', 'IBMPlexSansArabic') // Use your Arabic font
                ->setOption('isRemoteEnabled', true) // Enable external assets (e.g., images)
                ->setOption('isHtml5ParserEnabled', true)
                ->setOption('direction', 'rtl'); // Set RTL direction

        return $pdf->stream('report.pdf');
    }

    public function download(Request $request)
    {
        $selectedReports = Report::whereIn('id', $request->report_ids)
                                 ->with('bidders')
                                 ->get();
    
        $pdf = PDF::loadView('pdf/pdf_layout', compact('selectedReports'))
                ->setOption('defaultFont', 'IBMPlexSansArabic') // Use your Arabic font
                ->setOption('isRemoteEnabled', true) // Enable external assets (e.g., images)
                ->setOption('isHtml5ParserEnabled', true)
                ->setOption('direction', 'rtl'); // Set RTL direction

        return $pdf->download('report.pdf');
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
