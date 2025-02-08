<x-layout>

    <!-- resources/views/reports/index.blade.php -->
    <form method="POST" action="{{ route('reports.generate') }}">
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
                        <a href="{{ route('reports.show', $report) }}" class="btn btn-info">عرض</a>
                        <form action="{{ route('reports.destroy', $report) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-success">عرض PDF</button>
        <button type="submit" formaction="{{ route('reports.download') }}" class="btn btn-warning">تحميل PDF</button>
    </form>

    <!-- Add this script for "Select All" -->
    <script>
        document.getElementById('selectAll').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('input[name="report_ids[]"]');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });
    </script>

</x-layout>
