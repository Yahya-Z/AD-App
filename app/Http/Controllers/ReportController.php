<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bidder;
use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\Browsershot\Browsershot;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::all(); // Fetch all reports
        return view('reports.index', compact('reports')); // Pass $reports to the view
    }

    public function create()
    {
        $reports = Report::all();
        return view('reports.create', compact('reports'));   
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'offer_number' => 'required|string',
            'project' => 'required|string',
            'item' => 'required|string',
            'committees_members' => 'required|string',
            'committees_chairman' => 'required|string',
            'bidders' => 'required|array',
            'bidders.*.name' => 'required|string',
            'bidders.*.currency' => 'required|string',
            'bidders.*.amount' => 'required|numeric',
            'bidders.*.discount' => 'nullable|numeric',
            'bidders.*.commercial_register' => 'required|string',
            'bidders.*.tax_card' => 'required|string',
            'bidders.*.zakat_card' => 'required|string',
            'bidders.*.shop_license' => 'required|string',
            'bidders.*.notes' => 'nullable|string',
        ]);

        foreach ($validated['bidders'] as $key => $bidder) {
            $validated['bidders'][$key]['final_amount'] = $bidder['amount'] - ($bidder['discount'] ?? 0);
        }

        // Create the report
        $report = Report::create([
            'offer_number' => $validated['offer_number'],
            'project' => $validated['project'],
            'item' => $validated['item'],
            'committees_members' => $validated['committees_members'],
            'committees_chairman' => $validated['committees_chairman'],
        ]);

        foreach ($validated['bidders'] as $bidder) {
            $report->bidders()->create($bidder);
        }
        
        return redirect()->route('reports.index')->with('success', 'تم إضافة البيانات بنجاح');
    }

    public function show($id)
    {
        $report = Report::with('bidders')->findOrFail($id);
        return view('reports.show', compact('report'));
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
