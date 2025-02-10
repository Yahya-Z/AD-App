<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bidder;
use App\Models\Report;
use Spatie\Browsershot\Browsershot;

class BidderController extends Controller
{
    public function store(Request $request, $report_id) {
        $validated = $request->validate([
            'name' => 'required|string',
            'currency' => 'required|string',
            'amount' => 'required|numeric',
            'discount' => 'required|numeric',
            'final_amount' => 'required|numeric',
            'commercial_register' => 'required|string',
            'tax_card' => 'required|string',
            'zakat_card' => 'required|string',
            'shop_license' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $report = Report::findOrFail($report_id);
        $report->bidders()->create($validated);

        return redirect()->route('reports.show', $report_id)->with('success', 'Bidder added!');
    }
}
