<x-layout>

    <!-- resources/views/reports/report.blade.php -->
    @foreach ($selectedReports as $report)
        <div class="report-section"> <!-- Add CSS to separate reports -->
            <!-- Your existing report HTML here -->
            <h1>محضر فتح مظاريف عرض السعر رقم: {{ $report->offer_number }}</h1>
            <table>
                <tbody>
                    @foreach ($report->bidders as $bidder)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $bidder->name }}</td>
                            <td>{{ $bidder->currency }}</td>
                            <td>{{ $bidder->amount }}</td>
                            <td>{{ $bidder->discount }}</td>
                            <td>{{ $bidder->final_amount }}</td>
                            <td>{{ $bidder->commercial_register ? '✔️' : '❌' }}</td>
                            <td>{{ $bidder->tax_card ? '✔️' : '❌' }}</td>
                            <td>{{ $bidder->zakat_card ? '✔️' : '❌' }}</td>
                            <td>{{ $bidder->shop_license ? '✔️' : '❌' }}</td>
                            <td>{{ $bidder->notes }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach

</x-layout>