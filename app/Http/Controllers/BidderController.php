<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bidder;
use App\Models\Report;
use Spatie\Browsershot\Browsershot;

class BidderController extends Controller
{

    public function index()
    {
        $bidders = Bidder::with('reports')->get();
        return view('reports.index', compact('bidders'));
    }

    public function store(Request $request, Report $report) {

        // Debug incoming data

        if ($request->isMethod('get')) {
            return response()->json(['error' => 'Method Not Allowed'], 405);
        }

        // Check if multiple bidders are being added
        if ($request->has('bidders') && is_array($request->input('bidders'))) {
            foreach ($request->input('bidders') as $bidderData) {
            $validatedBidder = $request->validate([
                'bidders.*.name' => 'required|string',
                'bidders.*.currency' => 'required|string',
                'bidders.*.amount' => 'required|numeric',
                'bidders.*.discount' => 'required|numeric',
                'bidders.*.commercial_register' => 'required|string',
                'bidders.*.tax_card' => 'required|string',
                'bidders.*.zakat_card' => 'required|string',
                'bidders.*.shop_license' => 'required|string',
                'bidders.*.notes' => 'nullable|string',
            ]);

            // Automatically calculate final_amount for each bidder
            $validatedBidder['final_amount'] = $validatedBidder['amount'] - $validatedBidder['discount'];

            // Create the bidder for the report
            $report->bidders()->create($validatedBidder);
            }
        } else {
            // Validate the request for a single bidder
            $validated = $request->validate([
            'name' => 'required|string',
            'currency' => 'required|string',
            'amount' => 'required|numeric',
            'discount' => 'required|numeric',
            'commercial_register' => 'required|string',
            'tax_card' => 'required|string',
            'zakat_card' => 'required|string',
            'shop_license' => 'required|string',
            'notes' => 'nullable|string',
            ]);

            // Automatically calculate final_amount
            $validated['final_amount'] = $validated['amount'] - $validated['discount'];

            // Create the bidder for the report
            $report->bidders()->create($validated);
        }

        // Redirect back to the reports index with the $reports variable
        $reports = Report::all(); // Fetch all reports
        return redirect()->route('reports.show', $report->id)->with('success', 'تمت إضافة المزايدة بنجاح');
    }

    public function create(Report $report)
    {
        return view('bidders.create', compact('report'));
    }

    public function destroy(Report $report, Bidder $bidder)
    {
        $bidder->delete();
        return redirect()->route('reports.show', $report->id)->with('success', 'تم حذف عرض السعر بنجاح');
    }
}
