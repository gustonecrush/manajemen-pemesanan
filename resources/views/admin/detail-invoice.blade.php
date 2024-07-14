@extends('admin.layouts.main', [
    'title' => 'Detail Invoice CV Fajar Teknika',
    'active' => 'Invoice',
])

@section('content')
    <div class="flex-grow container mx-auto sm:px-4 pt-6 pb-8">
        <div class="bg-white border-t border-b sm:border-l sm:border-r sm:rounded shadow mb-6">
            <div class="border-b px-6">
                <div class="flex justify-between -mb-px">
                    <div class="lg:hidden text-blue-dark py-4 text-lg">
                        Price Charts
                    </div>
                    <div class="hidden lg:flex">
                        <button type="button" class="appearance-none py-4 text-blue-dark border-b border-primary mr-6">
                            <a href="{{ route('admin.invoicePage') }}">{{ $pemesanans->no_po }}</a> &middot;
                            Rekapitulasi
                            &middot; Invoice Pemesanan
                        </button>

                    </div>
                    <div class="flex text-sm">
                        <button type="button"
                            class="appearance-none py-4 text-grey-dark border-b border-transparent hover:border-grey-dark mr-3">
                            1M
                        </button>
                        <button type="button"
                            class="appearance-none py-4 text-grey-dark border-b border-transparent hover:border-grey-dark mr-3">
                            1D
                        </button>
                        <button type="button"
                            class="appearance-none py-4 text-grey-dark border-b border-transparent hover:border-grey-dark mr-3">
                            1W
                        </button>
                        <button type="button" class="appearance-none py-4 text-blue-dark border-b border-primary mr-3">
                            1M
                        </button>
                        <button type="button"
                            class="appearance-none py-4 text-grey-dark border-b border-transparent hover:border-grey-dark mr-3">
                            1Y
                        </button>
                        <button type="button"
                            class="appearance-none py-4 text-grey-dark border-b border-transparent hover:border-grey-dark">
                            ALL
                        </button>
                    </div>
                </div>
            </div>


        </div>

        <div class="flex flex-wrap -mx-4 mt-5">
            <div class="w-full mb-6 lg:mb-0  px-4 flex flex-col">
                <div class="flex-grow flex flex-col bg-white border-t border-b sm:rounded sm:border shadow overflow-hidden">
                    <div class="">
                        <button id="export-btn" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Send and Save Invoice
                        </button>
                    </div>
                    <div id="purchase-order" class="max-w-5xl mx-auto p-6 bg-white shadow-md mt-10">
                        <header class="flex justify-between items-center mb-6">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-800">{{ $pemesanans->mitra->name }}</h1>
                                <p class="text-sm text-gray-600">{{ $pemesanans->mitra->site }} - 10160</p>
                                <p class="text-sm text-gray-600">Mail: {{ $pemesanans->mitra->email }} Tlp:
                                    {{ $pemesanans->mitra->phone_number }}</p>
                            </div>
                            <h2 class="text-3xl font-bold text-gray-800">DELIVERY ORDER</h2>
                        </header>

                        <section class="mb-6">
                            <div class="flex justify-between">
                                <div class="w-1/2">
                                    <p class="text-sm text-gray-800 font-bold">TO: CV Fajar Teknika</p>
                                    <p class="text-sm text-gray-600">Jl. Lingga Raya Samping PLN Tanjungenim</p>
                                    <p class="text-sm text-gray-600">Tanjung Enim, Muara Enim, Sumsel</p>
                                    <p class="text-sm text-gray-600">HP: 082374069762</p>
                                    <p class="text-sm text-gray-600">Attn: Dwi Cahyo</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-sm text-gray-800"><span class="font-bold">PO Number:</span>
                                        {{ $pemesanans->no_po }}</p>
                                    <p class="text-sm text-gray-800"><span class="font-bold">DO Number:</span>
                                        {{ $pemesanans->no_do }}</p>
                                    <p class="text-sm text-gray-800"><span class="font-bold">PO Date:</span>
                                        {{ $pemesanans->date_order }}
                                    </p>
                                    <p class="text-sm text-gray-800"><span class="font-bold">Order Type:</span> 25017905
                                    </p>
                                    <p class="text-sm text-gray-800"><span class="font-bold">Reference:</span> I</p>
                                    <p class="text-sm text-gray-800"><span class="font-bold">Div / Dept.:</span> -</p>
                                    <p class="text-sm text-gray-800"><span class="font-bold">Site:</span>
                                        {{ $pemesanans->mitra->site }}</p>
                                </div>
                            </div>
                        </section>

                        <section class="mb-6">
                            <div class="flex justify-between">
                                <div class="w-1/2">
                                    <p class="text-sm text-gray-800 font-bold">PAYMENT TERMS / PEMBAYARAN</p>
                                    <p class="text-sm text-gray-600"><span class="font-bold">CASH / CREDIT:</span> Credit
                                    </p>
                                    <p class="text-sm text-gray-600"><span class="font-bold">DATE / Tgl Bayar:</span></p>
                                    <p class="text-sm text-gray-600"><span class="font-bold">CURRENCY:</span> IDR</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-sm text-gray-800 font-bold">DELIVERY / PENYERAHAN</p>
                                    <p class="text-sm text-gray-600"><span class="font-bold">SHIP TO:</span>
                                        {{ $pemesanans->mitra->name }}</p>
                                    <p class="text-sm text-gray-600"> {{ $pemesanans->mitra->site }}</p>
                                    <p class="text-sm text-gray-600"><span class="font-bold">REQUIRED DATE:</span></p>
                                </div>
                            </div>
                        </section>

                        <section>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            No.</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Description of Goods</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Qty</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Units</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Unit Price</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Discount</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Net Price</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Total</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($details as $index => $pemesanan)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $index + 1 }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $pemesanan->barang->kode_barang }}<br>
                                                {{ $pemesanan->barang->nama_barang }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $pemesanan->quantity }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $pemesanan->satuan }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $pemesanan->unit_price }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">-</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $pemesanan->unit_price }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $pemesanan->total }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </section>

                        <section class="mt-6">
                            <div class="flex justify-end">
                                <div class="w-1/3">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                                    Sub Total</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $subTotal }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                                    PPN / VAT</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ ($subTotal * 11) / 100 }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                                    TOTAL</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $subTotal + ($subTotal * 11) / 100 }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>

                        <footer class="mt-10">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-gray-600">RECEIVED BY</p>
                                    <p class="text-sm text-gray-800 font-bold">
                                        {{ $pemesanans->received_by }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">PREPARED BY</p>
                                    <p class="text-sm text-gray-800 font-bold">
                                        {{ $pemesanans->prepared_by }}

                                    </p>
                                </div>
                            </div>
                        </footer>
                    </div>


                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('[data-modal-toggle]');
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetModal = this.getAttribute('data-modal-target');
                    const modal = document.getElementById(targetModal);
                    modal.classList.toggle('hidden');
                });
            });

            const closeButtons = document.querySelectorAll('[data-modal-hide]');
            closeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetModal = this.getAttribute('data-modal-hide');
                    const modal = document.getElementById(targetModal);
                    modal.classList.toggle('hidden');
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.show-detail-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const pemesananId = this.getAttribute('data-pemesanan-id');
                    const modalId = `#detail-modal-${pemesananId}`;
                    const tableBody = document.querySelector(`#modal-table-body-${pemesananId}`);

                    // Clear previous data
                    tableBody.innerHTML = '';

                    // Fetch data via AJAX
                    fetch(`/admin/pemesanan/${pemesananId}/details`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(item => {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">${item.barang_id}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">${item.quantity}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">${item.satuan}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">${item.unit_price}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">${item.total}</td>
                        `;
                                tableBody.appendChild(row);
                            });
                        });

                    // Show the modal
                    const modal = new bootstrap.Modal(document.querySelector(modalId));
                    modal.show();
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
    <script>
        document.getElementById('export-btn').addEventListener('click', function() {


            html2canvas(document.getElementById('purchase-order')).then(function(canvas) {
                canvas.toBlob(function(blob) {
                    var link = document.createElement('a');
                    link.href = URL.createObjectURL(blob);
                    link.download = 'purchase_order.png';
                    link.click();
                    URL.revokeObjectURL(link.href);
                    Toastify({
                        text: "Successfully downloaded PO",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#48bb78",
                        stopOnFocus: true
                    }).showToast();
                });
            }).catch(error => {
                console.error('Error:', error);
                Toastify({
                    text: "Download failed",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#f56565",
                    stopOnFocus: true
                }).showToast();
            });
        });
    </script>
@endsection
