<x-layout>

    <!-- resources/views/reports/index.blade.php -->
    <form method="POST" action="{{ route('reports.generate') }}" id="pdfForm">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll"></th> <!-- Add this -->
                    <th>رقم العرض</th>
                    <th>اسم المشروع</th>
                    <th>البند</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report)
                <tr>
                    <td><input type="checkbox" name="report_ids[]" value="{{ $report->id }}"></td> <!-- Add this -->
                    <td>{{ $report->offer_number }}</td>
                    <td>{{ $report->project }}</td>
                    <td>{{ $report->item }}</td>
                    <td>
                        <a href="{{ route('reports.show', $report->id) }}" class="btn btn-info">مشاهدة التفاصيل</a>
                        <form action="{{ route('reports.destroy', $report->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('reports.create') }}" class="btn btn-secondary">إضافة عرض</a>
        <button type="submit" class="btn btn-success">عرض PDF</button>
        <button type="button" onclick="{{ route('reports.generate', $report->id) }}" class="btn btn-warning">تحميل PDF</button>
    </form>

    <script>
        document.getElementById('selectAll').addEventListener('change', function () {
            let checkboxes = document.querySelectorAll('input[name="report_ids[]"]');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });
    </script>

</x-layout>
