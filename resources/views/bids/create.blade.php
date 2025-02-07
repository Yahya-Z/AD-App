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

                    <!-- resources/views/reports/create.blade.php -->
                    <form method="POST" action="{{ route('reports.store') }}">
                        @csrf

                        <!-- Report Details -->
                        <div>
                            <label>رقم العرض:</label>
                            <input type="text" name="offer_number" required>
                        </div>
                        <div>
                            <label>اسم المشروع:</label>
                            <input type="text" name="project" required>
                        </div>
                        <div>
                            <label>البند:</label>
                            <input type="text" name="item" required>
                        </div>

                        <!-- Bidders (Dynamic Fields) -->
                        <div id="bidders">
                            <div class="bidder">
                                <h3>المتقدم 1</h3>
                                <div>
                                    <label>اسم المتقدم:</label>
                                    <input type="text" name="bidders[0][name]" required>
                                </div>
                                <div>
                                    <label>عملة العطاء:</label>
                                    <select name="bidders[0][currency]">
                                        <option value="ريال سعودي">ريال سعودي</option>
                                        <option value="دولار">دولار</option>
                                    </select>
                                </div>
                                <div>
                                    <label>المبلغ المقدم:</label>
                                    <input type="number" name="bidders[0][amount]" required>
                                </div>
                                <div>
                                    <label>التخفيض:</label>
                                    <input type="number" name="bidders[0][discount]">
                                </div>
                                <div>
                                    <label>وثائق الشركة:</label>
                                    <input type="checkbox" name="bidders[0][commercial_register]"> السجل التجاري
                                    <input type="checkbox" name="bidders[0][tax_card]"> البطاقة الضريبية
                                    <input type="checkbox" name="bidders[0][zakat_card]"> البطاقة الزكوية
                                    <input type="checkbox" name="bidders[0][shop_license]"> ترخيص المحل
                                </div>
                                <div>
                                    <label>ملاحظات:</label>
                                    <textarea name="bidders[0][notes]"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="button" onclick="addBidder()">إضافة متقدم جديد</button>
                        <button type="submit">حفظ</button>
                    </form>

                    <script>
                        let bidderCount = 1;

                        function addBidder() {
                            const newBidder = document.createElement('div');
                            newBidder.className = 'bidder';
                            newBidder.innerHTML = `
                                <h3>المتقدم ${bidderCount + 1}</h3>
                                <div>
                                    <label>اسم المتقدم:</label>
                                    <input type="text" name="bidders[${bidderCount}][name]" required>
                                </div>
                                <div>
                                    <label>عملة العطاء:</label>
                                    <select name="bidders[${bidderCount}][currency]">
                                        <option value="ريال سعودي">ريال سعودي</option>
                                        <option value="دولار">دولار</option>
                                    </select>
                                </div>
                                <div>
                                    <label>المبلغ المقدم:</label>
                                    <input type="number" name="bidders[${bidderCount}][amount]" required>
                                </div>
                                <div>
                                    <label>التخفيض:</label>
                                    <input type="number" name="bidders[${bidderCount}][discount]">
                                </div>
                                <div>
                                    <label>وثائق الشركة:</label>
                                    <input type="checkbox" name="bidders[${bidderCount}][commercial_register]"> السجل التجاري
                                    <input type="checkbox" name="bidders[${bidderCount}][tax_card]"> البطاقة الضريبية
                                    <input type="checkbox" name="bidders[${bidderCount}][zakat_card]"> البطاقة الزكوية
                                    <input type="checkbox" name="bidders[${bidderCount}][shop_license]"> ترخيص المحل
                                </div>
                                <div>
                                    <label>ملاحظات:</label>
                                    <textarea name="bidders[${bidderCount}][notes]"></textarea>
                                </div>
                            `;
                            document.getElementById('bidders').appendChild(newBidder);
                            bidderCount++;
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

</x-layout>
