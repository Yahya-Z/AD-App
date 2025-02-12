<x-layout>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="card-title mb-4 text-center">إنشاء مشروع جديد</h2>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('reports.store') }}">
                        @csrf
                        @if(isset($report))
                            <input type="hidden" name="report_id" value="{{ $report->id }}">
                        @endif

                        <div class="form-group">
                            <label for="offer_number">رقم العرض:</label>
                            <input type="text" id="offer_number" name="offer_number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="project">اسم المشروع:</label>
                            <input type="text" id="project" name="project" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="item">الخاص بتوريد وشراء:</label>
                            <input type="text" id="item" name="item" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="committees_members">أعضاء اللجنة:</label>
                            <input type="text" id="committees_members" name="committees_members" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="committees_chairman">رئيس اللجنة:</label>
                            <input type="text" id="committees_chairman" name="committees_chairman" class="form-control" required>
                        </div>

                        <!-- Bidders Fields -->
                        <div class="my-5">
                        <div class="form-group">
                            <label for="name">اسم المتقدم:</label>
                            <input type="text" id="name" name="bidders[0][name]" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="currency">عملة العطاء:</label>
                            <select id="currency" name="bidders[0][currency]" class="form-control">
                                <option value="ريال سعودي">ريال سعودي</option>
                                <option value="دولار">دولار</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">المبلغ المقدم:</label>
                            <input type="number" id="amount" name="bidders[0][amount]" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="discount">التخفيض:</label>
                            <input type="number" id="discount" name="bidders[0][discount]" class="form-control">
                        </div>
                        <label class="form-label">وثائق الشركة:</label>
                        <div class="form-group">
                            <label for="commercial_register">السجل التجاري:</label>
                            <input type="text" id="commercial_register" name="bidders[0][commercial_register]" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="tax_card">البطاقة الضريبية:</label>
                            <input type="text" id="tax_card" name="bidders[0][tax_card]" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="zakat_card">البطاقة الزكوية:</label>
                            <input type="text" id="zakat_card" name="bidders[0][zakat_card]" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="shop_license">ترخيص المحل:</label>
                            <input type="text" id="shop_license" name="bidders[0][shop_license]" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="notes">ملاحظات:</label>
                            <textarea id="notes" name="bidders[0][notes]" class="form-control"></textarea>
                        </div>
                        </div>

                        <div id="bidders"></div>
                        <button type="button" class="btn btn-secondary mb-3" onclick="addBidder()">إضافة متقدم اخر</button>
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
                                <button type="button" class="btn btn-danger" onclick="removeBidder(this)">إزالة المتقدم</button>
                            `;
                            document.getElementById('bidders').appendChild(newBidder);
                            bidderCount++;
                        }

                        function removeBidder(button) {
                            button.parentElement.remove();
                            bidderCount--;
                            const bidders = document.querySelectorAll('.bidder');
                            bidders.forEach((bidder, index) => {
                                bidder.querySelector('h3').innerText = `المتقدم ${index + 1}`;
                                bidder.querySelectorAll('input, select, textarea').forEach(input => {
                                    const name = input.getAttribute('name');
                                    const id = input.getAttribute('id');
                                    if (name) {
                                        input.setAttribute('name', name.replace(/\[\d+\]/, `[${index}]`));
                                    }
                                    if (id) {
                                        input.setAttribute('id', id.replace(/_\d+_/, `_${index}_`));
                                    }
                                });
                            });
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
