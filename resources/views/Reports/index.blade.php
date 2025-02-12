<x-layout>

<div class="container text-right">
    <h2 class="text-center">تقارير المناقصات</h2>
    <a href="{{ route('reports.create') }}" class="btn btn-primary">إضافة تقرير جديد</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>رقم العرض</th>
                <th>المشروع</th>
                <th>العناصر</th>
                <th>الإجراء</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
            <tr>
                    <td>{{ $report->offer_number }}</td>
                    <td>{{ $report->project }}</td>
                    <td>{{ $report->item }}</td>
                    <td>
                        <a href="{{ route('reports.show', $report->id) }}" class="btn btn-info">عرض التفاصيل</a>
                        <a href="{{ route('pdf.view', $report->id) }}" class="btn btn-warning" target="_blank">عرض PDF</a>
                        <a href="{{ route('pdf.download', $report->id) }}" class="btn btn-success" target="_blank">تحميل PDF</a>
                        <form action="{{ route('bidders.create', $report->id) }}" method="get">
                            @csrf
                            <button type="submit" class="btn btn-secondary">إضافة مزايدة</button>
                        </form>
                        <a href="{{ route('reports.destroy', $report->id) }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $report->id }}').submit();">حذف تقرير</a>
                        <form id="delete-form-{{ $report->id }}" action="{{ route('reports.destroy', $report->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</x-layout>
