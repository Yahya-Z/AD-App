<x-layout>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="card-title mb-4 text-center">Create Report</h2>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('reports.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="report_id">اختر المشروع:</label>
                            <select id="report_id" name="report_id" class="form-control" onchange="updatereportDetails()" required>
                                <option value="">اختر العرض</option>
                                @foreach($reports as $report)
                                    <option value="{{ $report->id }}" data-report-number="{{ $report->offer_number }}" data-project="{{ $report->project }}">
                                        {{ $report->offer_number }} - {{ $report->project }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="offer_number">رقم العرض:</label>
                            <input type="text" id="offer_number" name="offer_number" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="project">اسم المشروع:</label>
                            <input type="text" id="project" name="project" class="form-control" readonly>
                        </div>

                        <!-- Bidders (Dynamic Fields) -->
                        <div id="bidders">
                            <div class="bidder mb-4">
                                <h3 class="mb-3">المتقدم 1</h3>
                                <div class="mb-3">
                                    <label for="bidders_0_name" class="form-label">اسم المتقدم:</label>
                                    <input type="text" class="form-control" id="bidders_0_name" name="bidders[0][name]" required>
                                </div>
                                <div class="mb-3">
                                    <label for="bidders_0_currency" class="form-label">عملة العطاء:</label>
                                    <select class="form-select" id="bidders_0_currency" name="bidders[0][currency]">
                                        <option value="ريال سعودي">ريال سعودي</option>
                                        <option value="دولار">دولار</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="bidders_0_amount" class="form-label">المبلغ المقدم:</label>
                                    <input type="number" class="form-control" id="bidders_0_amount" name="bidders[0][amount]" required>
                                </div>
                                <div class="mb-3">
                                    <label for="bidders_0_discount" class="form-label">التخفيض:</label>
                                    <input type="number" class="form-control" id="bidders_0_discount" name="bidders[0][discount]">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">وثائق الشركة:</label>
                                    <div class="mb-3">
                                        <label for="bidders_0_commercial_register" class="form-label">السجل التجاري:</label>
                                        <input type="text" class="form-control" id="bidders_0_commercial_register" name="bidders[0][commercial_register]">
                                    </div>
                                    <div class="mb-3">
                                        <label for="bidders_0_tax_card" class="form-label">البطاقة الضريبية:</label>
                                        <input type="text" class="form-control" id="bidders_0_tax_card" name="bidders[0][tax_card]">
                                    </div>
                                    <div class="mb-3">
                                        <label for="bidders_0_zakat_card" class="form-label">البطاقة الزكوية:</label>
                                        <input type="text" class="form-control" id="bidders_0_zakat_card" name="bidders[0][zakat_card]">
                                    </div>
                                    <div class="mb-3">
                                        <label for="bidders_0_shop_license" class="form-label">ترخيص المحل:</label>
                                        <input type="text" class="form-control" id="bidders_0_shop_license" name="bidders[0][shop_license]">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="bidders_0_notes" class="form-label">ملاحظات:</label>
                                    <textarea class="form-control" id="bidders_0_notes" name="bidders[0][notes]"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-secondary mb-3" onclick="addBidder()">إضافة متقدم جديد</button>
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </form>

                    <script>
                        let bidderCount = 1;

                        function addBidder() {
                            const newBidder = document.createElement('div');
                            newBidder.className = 'bidder mb-4';
                            newBidder.innerHTML = `
                                <h3 class="mb-3">المتقدم ${bidderCount + 1}</h3>
                                <div class="mb-3">
                                    <label for="bidders_${bidderCount}_name" class="form-label">اسم المتقدم:</label>
                                    <input type="text" class="form-control" id="bidders_${bidderCount}_name" name="bidders[${bidderCount}][name]" required>
                                </div>
                                <div class="mb-3">
                                    <label for="bidders_${bidderCount}_currency" class="form-label">عملة العطاء:</label>
                                    <select class="form-select" id="bidders_${bidderCount}_currency" name="bidders[${bidderCount}][currency]">
                                        <option value="ريال سعودي">ريال سعودي</option>
                                        <option value="دولار">دولار</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="bidders_${bidderCount}_amount" class="form-label">المبلغ المقدم:</label>
                                    <input type="number" class="form-control" id="bidders_${bidderCount}_amount" name="bidders[${bidderCount}][amount]" required>
                                </div>
                                <div class="mb-3">
                                    <label for="bidders_${bidderCount}_discount" class="form-label">التخفيض:</label>
                                    <input type="number" class="form-control" id="bidders_${bidderCount}_discount" name="bidders[${bidderCount}][discount]">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">وثائق الشركة:</label>
                                    <div class="mb-3">
                                        <label for="bidders_${bidderCount}_commercial_register" class="form-label">السجل التجاري:</label>
                                        <input type="text" class="form-control" id="bidders_${bidderCount}_commercial_register" name="bidders[${bidderCount}][commercial_register]">
                                    </div>
                                    <div class="mb-3">
                                        <label for="bidders_${bidderCount}_tax_card" class="form-label">البطاقة الضريبية:</label>
                                        <input type="text" class="form-control" id="bidders_${bidderCount}_tax_card" name="bidders[${bidderCount}][tax_card]">
                                    </div>
                                    <div class="mb-3">
                                        <label for="bidders_${bidderCount}_zakat_card" class="form-label">البطاقة الزكوية:</label>
                                        <input type="text" class="form-control" id="bidders_${bidderCount}_zakat_card" name="bidders[${bidderCount}][zakat_card]">
                                    </div>
                                    <div class="mb-3">
                                        <label for="bidders_${bidderCount}_shop_license" class="form-label">ترخيص المحل:</label>
                                        <input type="text" class="form-control" id="bidders_${bidderCount}_shop_license" name="bidders[${bidderCount}][shop_license]">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="bidders_${bidderCount}_notes" class="form-label">ملاحظات:</label>
                                    <textarea class="form-control" id="bidders_${bidderCount}_notes" name="bidders[${bidderCount}][notes]"></textarea>
                                </div>
                            `;
                            document.getElementById('bidders').appendChild(newBidder);
                            bidderCount++;
                        }

                        function updatereportDetails() {
                            var select = document.getElementById('report_id');
                            var selectedOption = select.options[select.selectedIndex];
                            var reportNumber = selectedOption.getAttribute('data-report-number');
                            var projectName = selectedOption.getAttribute('data-project');

                            document.getElementById('offer_number').value = reportNumber;
                            document.getElementById('project').value = projectName;
                        }

                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

</x-layout>
