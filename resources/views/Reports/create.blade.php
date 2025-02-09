<x-layout>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="card-title mb-4 text-center">Create New Project</h2>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('reports.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="offer_number">Offer Number:</label>
                            <input type="text" id="offer_number" name="offer_number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="project">Project Name:</label>
                            <input type="text" id="project" name="project" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="item">Item:</label>
                            <input type="text" id="item" name="item" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="committees_members">Committee Members:</label>
                            <input type="text" id="committees_members" name="committees_members" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="committees_chairman">Committee Chairman:</label>
                            <input type="text" id="committees_chairman" name="committees_chairman" class="form-control" required>
                        </div>

                        <!-- Bidders (Dynamic Fields) -->
                        <div id="bidders">
                            <div class="bidder mb-4">
                                <h3 class="mb-3">Bidder 1</h3>
                                <div class="mb-3">
                                    <label for="bidders_0_name" class="form-label">Bidder Name:</label>
                                    <input type="text" class="form-control" id="bidders_0_name" name="bidders[0][name]" required>
                                </div>
                                <div class="mb-3">
                                    <label for="bidders_0_currency" class="form-label">Bid Currency:</label>
                                    <select class="form-select" id="bidders_0_currency" name="bidders[0][currency]">
                                        <option value="ريال سعودي">ريال سعودي</option>
                                        <option value="دولار">دولار</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="bidders_0_amount" class="form-label">Bid Amount:</label>
                                    <input type="number" class="form-control" id="bidders_0_amount" name="bidders[0][amount]" required>
                                </div>
                                <div class="mb-3">
                                    <label for="bidders_0_discount" class="form-label">Discount:</label>
                                    <input type="number" class="form-control" id="bidders_0_discount" name="bidders[0][discount]">
                                </div>
                                <div class="mb-3">
                                    <label for="bidders_0_commercial_register" class="form-label">Commercial Register:</label>
                                    <input type="text" class="form-control" id="bidders_0_commercial_register" name="bidders[0][commercial_register]">
                                </div>
                                <div class="mb-3">
                                    <label for="bidders_0_tax_card" class="form-label">Tax Card:</label>
                                    <input type="text" class="form-control" id="bidders_0_tax_card" name="bidders[0][tax_card]">
                                </div>
                                <div class="mb-3">
                                    <label for="bidders_0_zakat_card" class="form-label">Zakat Card:</label>
                                    <input type="text" class="form-control" id="bidders_0_zakat_card" name="bidders[0][zakat_card]">
                                </div>
                                <div class="mb-3">
                                    <label for="bidders_0_shop_license" class="form-label">Shop License:</label>
                                    <input type="text" class="form-control" id="bidders_0_shop_license" name="bidders[0][shop_license]">
                                </div>
                                <div class="mb-3">
                                    <label for="bidders_0_notes" class="form-label">Notes:</label>
                                    <textarea class="form-control" id="bidders_0_notes" name="bidders[0][notes]"></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-secondary mb-3" onclick="addBidder()">Add New Bidder</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>

                    <script>
                        let bidderCount = 1;

                        function addBidder() {
                            const newBidder = document.createElement('div');
                            newBidder.className = 'bidder mb-4';
                            newBidder.innerHTML = `
                                <h3 class="mb-3">Bidder ${bidderCount + 1}</h3>
                                <div class="mb-3">
                                    <label for="bidders_${bidderCount}_name" class="form-label">Bidder Name:</label>
                                    <input type="text" class="form-control" id="bidders_${bidderCount}_name" name="bidders[${bidderCount}][name]" required>
                                </div>
                                <div class="mb-3">
                                    <label for="bidders_${bidderCount}_currency" class="form-label">Bid Currency:</label>
                                    <select class="form-select" id="bidders_${bidderCount}_currency" name="bidders[${bidderCount}][currency]">
                                        <option value="ريال سعودي">ريال سعودي</option>
                                        <option value="دولار">دولار</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="bidders_${bidderCount}_amount" class="form-label">Bid Amount:</label>
                                    <input type="number" class="form-control" id="bidders_${bidderCount}_amount" name="bidders[${bidderCount}][amount]" required>
                                </div>
                                <div class="mb-3">
                                    <label for="bidders_${bidderCount}_discount" class="form-label">Discount:</label>
                                    <input type="number" class="form-control" id="bidders_${bidderCount}_discount" name="bidders[${bidderCount}][discount]">
                                </div>
                                <div class="mb-3">
                                    <label for="bidders_${bidderCount}_commercial_register" class="form-label">Commercial Register:</label>
                                    <input type="text" class="form-control" id="bidders_${bidderCount}_commercial_register" name="bidders[${bidderCount}][commercial_register]">
                                </div>
                                <div class="mb-3">
                                    <label for="bidders_${bidderCount}_tax_card" class="form-label">Tax Card:</label>
                                    <input type="text" class="form-control" id="bidders_${bidderCount}_tax_card" name="bidders[${bidderCount}][tax_card]">
                                </div>
                                <div class="mb-3">
                                    <label for="bidders_${bidderCount}_zakat_card" class="form-label">Zakat Card:</label>
                                    <input type="text" class="form-control" id="bidders_${bidderCount}_zakat_card" name="bidders[${bidderCount}][zakat_card]">
                                </div>
                                <div class="mb-3">
                                    <label for="bidders_${bidderCount}_shop_license" class="form-label">Shop License:</label>
                                    <input type="text" class="form-control" id="bidders_${bidderCount}_shop_license" name="bidders[${bidderCount}][shop_license]">
                                </div>
                                <div class="mb-3">
                                    <label for="bidders_${bidderCount}_notes" class="form-label">Notes:</label>
                                    <textarea class="form-control" id="bidders_${bidderCount}_notes" name="bidders[${bidderCount}][notes]"></textarea>
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
