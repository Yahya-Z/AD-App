<x-layout>

<div class="container text-right">
    <h1 class="text-center mb-4">محضر فتح مظاريف عرض السعر رقم: {{ $report->offer_number }}</h1>
    <p class="text-center">الخاص بشراء وتوريد <strong>{{ $report->item }}</strong> ضمن مشروع <strong>{{ $report->project }}</strong></p>
    
    <h3>المتقدمون</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>اسم المتقدم</th>
                <th>عملة العطاء</th>
                <th>المبلغ المقدم</th>
                <th>التخفيض</th>
                <th>المبلغ بعد التخفيض</th>
                <th>السجل التجاري</th>
                <th>البطاقة الضريبية</th>
                <th>البطاقة الزكوية</th>
                <th>ترخيص المحل</th>
                <th>ملاحظات</th>
            </tr>
        </thead>
        <tbody>
                @foreach ($report->bidders as $bidder)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $bidder->name }}</td>
                    <td>{{ $bidder->currency }}</td>
                    <td>{{ $bidder->amount }}</td>
                    <td>{{ $bidder->discount }}</td>
                    <td>{{ $bidder->amount - $bidder->discount }}</td>
                    <td>{{ $bidder->commercial_register }}</td>
                    <td>{{ $bidder->tax_card }}</td>
                    <td>{{ $bidder->zakat_card }}</td>
                    <td>{{ $bidder->shop_license }}</td>
                    <td>{{ $bidder->notes }}</td>
                </tr>
                @endforeach
        </tbody>
    </table>

    <div class="committee mt-4">
        <p>رئيس اللجنة: {{ $report->committees_chairman }}</p>
        <p>أعضاء اللجنة: {{ $report->committees_members }}</p>
    </div>

    <div class="mt-4">
        <a href="{{ route('reports.index') }}" class="btn btn-secondary">العودة إلى القائمة</a>
    </div>


</div>
        <!-- <div class="mt-4">
            <a href="{{ route('reports.index') }}" class="btn btn-secondary">العودة إلى القائمة</a>
        </div>
        <div class="mt-4">
            <a href="{{ route('bidders.create') }}" class="btn btn-secondary">إضافة متقدم اخر</a>
        </div>
    </div> -->
    
</x-layout>
