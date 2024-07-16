@extends('admin.layouts.main', [
    'title' => 'Detail Pemesanan CV Fajar Teknika',
    'active' => 'Pemesanan',
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
                            <a href="{{ route('admin.pemesananPage') }}">{{ $pemesanans->no_po }}</a> &middot; Rekapitulasi
                            &middot; Data Pemesanan Masuk
                        </button>

                    </div>
                 
                </div>
            </div>


        </div>
        <div class="flex flex-wrap -mx-4">
            <div class="w-full mb-6 lg:mb-0  px-4 flex flex-col">
                <div class="flex-grow flex flex-col bg-white border-t border-b sm:rounded sm:border shadow overflow-hidden">
                    <div class="border-b">
                        <div class="flex justify-between px-6 -mb-px items-center gap-2">
                            <h3
                                class="text-blue-dark py-4 flex justify-between px-6 -mb-px items-center gap-2 font-normal text-lg">
                                <i class='bx bxl-dropbox text-3xl'></i>Data
                                Barang CV
                                Fajar Teknika
                            </h3>
                            <div class="flex">


                            </div>
                        </div>
                    </div>
                    <table class="w-full text-sm text-left  rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs  text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 font-medium text-sm text-center">No</th>
                                <th scope="col" class="px-6 py-3 font-medium text-sm text-center">Nama Barang</th>
                                <th scope="col" class="px-6 py-3 font-medium text-sm text-center">Harga</th>
                                <th scope="col" class="px-6 py-3 font-medium text-sm text-center">Kuantitas Pembelian
                                </th>
                                <th scope="col" class="px-6 py-3 font-medium text-sm text-center">Satuan</th>
                                <th scope="col" class="px-6 py-3 font-medium text-sm text-center">Total Harga</th>

                                <th scope="col" class="px-6 py-3 font-medium text-sm text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-800">
                            @foreach ($details as $index => $pemesanan)
                                <tr class="transition-all hover:bg-[#f9f9f9]">
                                    <td class="px-6 py-4 text-center">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 text-center">{{ $pemesanan->barang->nama_barang }}</td>
                                    <td class="px-6 py-4 text-center">Rp. {{ $pemesanan->barang->harga_jual }}</td>
                                    <td class="px-6 py-4 text-center">{{ $pemesanan->quantity }}</td>
                                    <td class="px-6 py-4 text-center">{{ $pemesanan->satuan }}</td>
                                    <td class="px-6 py-4 text-center">Rp. {{ $pemesanan->total }}</td>
                                    <td class="px-6 py-4 text-center flex gap-2">
                                        {{-- <button data-modal-target="add-pesanan-modal-{{ $pemesanan->id }}"
                                            data-modal-toggle="add-pesanan-modal-{{ $pemesanan->id }}"
                                            class="font-medium text-gray-500 dark:text-gray-500 hover:underline">
                                            <i class='bx bxl-dropbox text-sm'></i>Pesanan
                                        </button> --}}


                                        <form action="{{ route('mitra.barangPemesanan.destroy') }}" method="POST"
                                            onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" value="{{ $pemesanan->id }}" name="id">
                                            <button type="submit"
                                                class="font-medium text-red-600 dark:text-red-500 text-sm hover:underline">
                                                <i class='bx bx-trash-alt'></i>Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal for Editing Produksi -->
                                <div id="edit-pemesanan-modal-{{ $pemesanan->id }}" tabindex="-1" aria-hidden="true"
                                    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative w-full max-w-lg max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <div
                                                class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Edit Data Pemesanan
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-hide="edit-pemesanan-modal-{{ $pemesanan->id }}">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 111.414 1.414L11.414 10l4.293 4.293a1 1 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="p-6 space-y-0">
                                                <form action="{{ route('admin.pemesanan.update') }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" value="{{ $pemesanan->id }}" name="id">
                                                    <input type="hidden" value="{{ $pemesanan->mitra_id }}"
                                                        name="mitra_id">
                                                    <input type="hidden" value="" name="received_by">
                                                    <input type="hidden" value="" name="prepared_by">
                                                    <div class="flex gap-2 w-full">
                                                        <div class="mb-4 w-full">
                                                            <label for="no_po"
                                                                class="block mb-2 font-medium text-gray-500 dark:text-white text-sm">Nomor
                                                                PO
                                                            </label>
                                                            <input type="text" id="no_po" name="no_po"
                                                                class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:border-primary focus:outline-primary focus:ring-primary dark:text-white"
                                                                value="{{ $pemesanan->no_po }}">
                                                            @error('no_po')
                                                                <div class="text-red-500 text-xs">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-4 w-full">
                                                            <label for="no_do"
                                                                class="block mb-2 font-medium text-gray-500 dark:text-white text-sm">Nomor
                                                                DO
                                                            </label>
                                                            <input type="text" id="no_do" name="no_do"
                                                                class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:border-primary focus:outline-primary focus:ring-primary dark:text-white"
                                                                value="{{ $pemesanan->no_do }}" readonly>
                                                            @error('no_do')
                                                                <div class="text-red-500 text-xs">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="flex gap-2 w-full">
                                                        <div class="mb-4 w-full">
                                                            <label for="date_order"
                                                                class="block mb-2 font-medium text-gray-500 dark:text-white text-sm">Tanggal
                                                                Pemesanan
                                                            </label>
                                                            <input type="datetime-local" id="date_order"
                                                                name="date_order"
                                                                class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:border-primary focus:outline-primary focus:ring-primary dark:text-white"
                                                                value="{{ $pemesanan->date_order }}">
                                                            @error('date_order')
                                                                <div class="text-red-500 text-xs">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-4 w-full">
                                                            <label for="unit"
                                                                class="block mb-2 font-medium text-gray-500 dark:text-white text-sm">Unit
                                                            </label>
                                                            <input type="text" id="unit" name="unit"
                                                                class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:border-primary focus:outline-primary focus:ring-primary dark:text-white"
                                                                value="{{ $pemesanan->unit }}">
                                                            @error('unit')
                                                                <div class="text-red-500 text-xs">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="flex gap-2 w-full">
                                                        {{-- <div class="mb-4 w-full">
                                                            <label for="prepared_by"
                                                                class="block mb-2 font-medium text-gray-500 dark:text-white text-sm">Dipersiapkan
                                                                oleh
                                                            </label>
                                                            <input type="text" id="prepared_by" name="prepared_by"
                                                                class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:border-primary focus:outline-primary focus:ring-primary dark:text-white"
                                                                value="{{ $pemesanan->prepared_by }}">
                                                            @error('prepared_by')
                                                                <div class="text-red-500 text-xs">{{ $message }}</div>
                                                            @enderror
                                                        </div> --}}
                                                        <div class="mb-4 w-full">

                                                            <input type="hidden" id="received_by" name="received_by"
                                                                class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:border-primary focus:outline-primary focus:ring-primary dark:text-white"
                                                                value="" readonly>
                                                            @error('received_by')
                                                                <div class="text-red-500 text-xs">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="flex items-center justify-end">
                                                        <button type="submit"
                                                            class="text-white bg-primary focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary dark:hover:bg-primary dark:focus:ring-primary">
                                                            Update Data
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="flex flex-wrap -mx-4 mt-10">
            <div class="w-full mb-6 lg:mb-0  px-4 flex flex-col">
                <div
                    class="flex-grow flex flex-col bg-white border-t border-b sm:rounded sm:border shadow overflow-hidden">
                    <div class="">
                        <button id="export-btn" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Download
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
                            <h2 class="text-3xl font-bold text-gray-800">PURCHASE ORDER</h2>
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
                                    <p class="text-sm text-gray-600">ORDERED BY</p>
                                    <p class="text-sm text-gray-800 font-bold">{{ $pemesanans->mitra->name }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">AUTHORIZED SUPPLIER</p>
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
