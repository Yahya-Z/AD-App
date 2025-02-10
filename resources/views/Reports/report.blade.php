<x-layout>

    <!-- resources/views/reports/report.blade.php -->
    @foreach ($selectedReports as $report)
        <div class="report-section"> <!-- Add CSS to separate reports -->
            <!-- Your existing report HTML here -->
            <h1>محضر فتح مظاريف عرض السعر رقم: {{ $report->offer_number }}</h1>
            <p><strong>الخاص بتوريد وشراء:</strong> {{ $report->item }}
            <strong>ضمن مشروع:</strong> {{ $report->project }}</p>

            <table>
                <thead>
                    <tr>
                        <th rowspan="2">#</th>
                        <th rowspan="2">اسم المتقدم</th>
                        <th rowspan="2">عملة العطاء</th>
                        <th rowspan="2">المبلغ المقدم</th>
                        <th rowspan="2">التخفيض</th>
                        <th rowspan="2">المبلغ بعد التخفيض</th>
                        <th colspan="4">وثائق الشركة سارية المفعول</th>
                        <th rowspan="2">ملاحظات</th>
                    </tr>
                    <tr>
                        <th>السجل التجاري</th>
                        <th>البطاقة الضريبية</th>
                        <th>البطاقة الزكوية</th>
                        <th>ترخيص المحل</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($report->bidders as $bidder)
                        <tr>
                            <!-- <td>{{ $loop->iteration }}</td> -->
                            <td>{{ $bidder->name }}</td>
                            <td>{{ $bidder->currency }}</td>
                            <td>{{ number_format($bidder->amount, 2) }}</td>
                            <td>{{ number_format($bidder->discount, 2) }}</td>
                            <td>{{ number_format($bidder->final_amount, 2) }}</td>
                            <td>{{ $bidder->commercial_register }}</td>
                            <td>{{ $bidder->tax_card }}</td>
                            <td>{{ $bidder->zakat_card }}</td>
                            <td>{{ $bidder->shop_license }}</td>
                            <td>{{ $bidder->notes }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach

</x-layout>