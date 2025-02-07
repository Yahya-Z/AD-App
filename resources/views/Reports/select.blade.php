<!-- resources/views/reports/select.blade.php -->
<x-layout>

    <form method="POST" action="{{ route('reports.generate') }}">
        @csrf
        @foreach ($reports as $report)
            <label>
                <input type="checkbox" name="report_ids[]" value="{{ $report->id }}">
                {{ $report->offer_number }} - {{ $report->project }}
            </label>
        @endforeach
        <button type="submit">Generate Report</button>
    </form>

</x-layout>