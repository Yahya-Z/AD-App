<x-layout>
    
<div class="report-section container mt-5"> <!-- Add CSS to separate reports -->
    <h1 class="text-center mb-4">محضر فتح مظاريف عرض السعر رقم: {{ $report->offer_number }}</h1>
    <p class="text-center"><strong>الخاص بتوريد وشراء:</strong> {{ $report->item }}
    <strong>ضمن مشروع:</strong> {{ $report->project }}</p>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th rowspan="2" class="align-middle text-center">#</th>
                    <th rowspan="2" class="align-middle text-center">اسم المتقدم</th>
                    <th rowspan="2" class="align-middle text-center">عملة العطاء</th>
                    <th rowspan="2" class="align-middle text-center">المبلغ المقدم</th>
                    <th rowspan="2" class="align-middle text-center">التخفيض</th>
                    <th rowspan="2" class="align-middle text-center">المبلغ بعد التخفيض</th>
                    <th colspan="4" class="text-center">وثائق الشركة سارية المفعول</th>
                    <th rowspan="2" class="align-middle text-center">ملاحظات</th>
                </tr>
                <tr>
                    <th class="text-center">السجل التجاري</th>
                    <th class="text-center">البطاقة الضريبية</th>
                    <th class="text-center">البطاقة الزكوية</th>
                    <th class="text-center">ترخيص المحل</th>
                </tr>
            </thead>
            <tbody>
                @foreach($report->bidders as $index => $bidder)
                    <tr>
                        <td class="align-middle text-center">{{ $index + 1 }}</td>
                        <td class="align-middle">{{ $bidder->name }}</td>
                        <td class="align-middle text-center">{{ $bidder->currency }}</td>
                        <td class="align-middle text-center">{{ number_format($bidder->amount, 2) }}</td>
                        <td class="align-middle text-center">{{ number_format($bidder->discount, 2) }}</td>
                        <td class="align-middle text-center">{{ number_format($bidder->final_amount, 2) }}</td>
                        <td class="align-middle text-center">{{ $bidder->comercial_register }}</td>
                        <td class="align-middle text-center">{{ $bidder->tax_card }}</td>
                        <td class="align-middle text-center">{{ $bidder->zakat_card }}</td>
                        <td class="align-middle text-center">{{ $bidder->shop_license }}</td>
                        <td class="align-middle">{{ $bidder->notes }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</x-layout>