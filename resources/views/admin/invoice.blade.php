@extends('admin.layouts.main', [
    'title' => 'Manajemen Data Invoice CV Fajar Teknika',
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
                            Rekapitulasi &middot; Invoice Pemesanan
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
            <div class="flex items-center px-6 lg:hidden">
                <div class="flex-grow flex-no-shrink py-6">
                    <div class="text-grey-darker mb-2">
                        <span class="text-3xl align-top">CA$</span>
                        <span class="text-5xl">21,404</span>
                        <span class="text-3xl align-top">.74</span>
                    </div>
                    <div class="text-green-light text-sm">
                        &uarr; CA$12,955.35 (154.16%)
                    </div>
                </div>
                <div class="flex-shrink w-32 inline-block relative">
                    <select class="block appearance-none w-full bg-white border border-grey-light px-4 py-2 pr-8 rounded">
                        <option>BTC</option>
                        <option>ETH</option>
                        <option>LTC</option>
                    </select>
                    <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="hidden lg:flex">
                <div class="w-full text-center py-8">
                    <div class="border-r">
                        <div class="text-grey-darker mb-2">
                            <span class="text-5xl">{{ $totalPemesanans }}</span>
                        </div>
                        <div class="text-sm uppercase text-grey tracking-wide">
                            Total Invoice
                        </div>
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
                                <i class='bx bxl-dropbox text-3xl'></i><span class="pf pf-invoice">Invoice</span>
                                Pemesanan CV
                                Fajar Teknika
                            </h3>

                        </div>
                    </div>
                    <table class="w-full text-sm text-left  rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs  text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 font-medium text-sm text-center">No</th>
                                <th scope="col" class="px-6 py-3 font-medium text-sm text-center">Mitra Pemesan</th>
                                <th scope="col" class="px-6 py-3 font-medium text-sm text-center">No. Pre-Order</th>
                                <th scope="col" class="px-6 py-3 font-medium text-sm text-center">No. Delivery Order</th>
                                <th scope="col" class="px-6 py-3 font-medium text-sm text-center">Tanggal Pemesanan</th>
                                <th scope="col" class="px-6 py-3 font-medium text-sm text-center">Unit</th>
                                <th scope="col" class="px-6 py-3 font-medium text-sm text-center">Received By</th>
                                <th scope="col" class="px-6 py-3 font-medium text-sm text-center">Prepared By</th>
                                <th scope="col" class="px-6 py-3 font-medium text-sm text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-800">
                            @foreach ($pemesanans as $index => $pemesanan)
                                <tr class="transition-all hover:bg-[#f9f9f9]">
                                    <td class="px-6 py-4 text-center">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 text-center">{{ $pemesanan->mitra->name }}</td>
                                    <td class="px-6 py-4 text-center">{{ $pemesanan->no_po }}</td>
                                    <td class="px-6 py-4 text-center">{{ $pemesanan->no_do }}</td>
                                    <td class="px-6 py-4 text-center">{{ $pemesanan->date_order }}</td>
                                    <td class="px-6 py-4 text-center">{{ $pemesanan->unit }}</td>
                                    <td class="px-6 py-4 text-center">{{ $pemesanan->received_by }}</td>
                                    <td class="px-6 py-4 text-center">{{ $pemesanan->prepared_by }}</td>

                                    <td class="px-6 py-4 text-center flex gap-2">
                                        <a href="/admin/invoice/{{ $pemesanan->id }}"
                                            class="font-medium text-gray-500 dark:text-gray-500 hover:underline">
                                            <i class='bx bxl-dropbox text-sm'></i>Invoice
                                        </a>


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
                                                                value="{{ $pemesanan->no_do }}">
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
                                                        <div class="mb-4 w-full">
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
                                                        </div>
                                                        <div class="mb-4 w-full">
                                                            <label for="received_by"
                                                                class="block mb-2 font-medium text-gray-500 dark:text-white text-sm">Diterima
                                                                oleh
                                                            </label>
                                                            <input type="text" id="received_by" name="received_by"
                                                                class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:border-primary focus:outline-primary focus:ring-primary dark:text-white"
                                                                value="{{ $pemesanan->received_by }}">
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
    </div>


    <div id="add-pemesanan-modal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-lg max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Tambah Pemesanan
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="add-pemesanan-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-6 space-y-6">
                    <form action="{{ route('admin.pemesanan.store') }}" method="POST">
                        @csrf
                        <div class="flex gap-2 w-full">
                            <div class="mb-4 w-full">
                                <label for="mitra_id"
                                    class="block mb-2 font-medium text-gray-500 dark:text-white text-sm">Mitra
                                </label>
                                <select id="mitra_id" name="mitra_id"
                                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:border-primary focus:outline-primary focus:ring-primary dark:text-white">
                                    <option value="">Pilih Pemesan</option>
                                    @foreach ($mitras as $mitra)
                                        <option value="{{ $mitra->id }}">{{ $mitra->name }} - {{ $mitra->site }}
                                            &middot; {{ $mitra->phone_number }}</option>
                                    @endforeach
                                </select>
                                @error('mitra_id')
                                    <div class="text-red-500 text-xs">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="flex gap-2 w-full">
                            <div class="mb-4 w-full">
                                <label for="no_po"
                                    class="block mb-2 font-medium text-gray-500 dark:text-white text-sm">Nomor PO
                                </label>
                                <input type="text" id="no_po" name="no_po"
                                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:border-primary focus:outline-primary focus:ring-primary dark:text-white">
                                @error('no_po')
                                    <div class="text-red-500 text-xs">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4 w-full">
                                <label for="no_do"
                                    class="block mb-2 font-medium text-gray-500 dark:text-white text-sm">Nomor DO
                                </label>
                                <input type="text" id="no_do" name="no_do"
                                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:border-primary focus:outline-primary focus:ring-primary dark:text-white">
                                @error('no_do')
                                    <div class="text-red-500 text-xs">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="flex gap-2 w-full">
                            <div class="mb-4 w-full">
                                <label for="date_order"
                                    class="block mb-2 font-medium text-gray-500 dark:text-white text-sm">Tanggal Order
                                </label>
                                <input type="date" id="date_order" name="date_order"
                                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:border-primary focus:outline-primary focus:ring-primary dark:text-white">
                                @error('date_order')
                                    <div class="text-red-500 text-xs">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4 w-full">
                                <label for="unit"
                                    class="block mb-2 font-medium text-gray-500 dark:text-white text-sm">Unit
                                </label>
                                <input type="text" id="unit" name="unit"
                                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:border-primary focus:outline-primary focus:ring-primary dark:text-white">
                                @error('unit')
                                    <div class="text-red-500 text-xs">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="flex gap-2 w-full">
                            <div class="mb-4 w-full">
                                <label for="prepared_by"
                                    class="block mb-2 font-medium text-gray-500 dark:text-white text-sm">Dipersiapkan Oleh
                                </label>
                                <input type="text" id="prepared_by" name="prepared_by"
                                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:border-primary focus:outline-primary focus:ring-primary dark:text-white">
                                @error('prepared_by')
                                    <div class="text-red-500 text-xs">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4 w-full">
                                <label for="received_by"
                                    class="block mb-2 font-medium text-gray-500 dark:text-white text-sm">Diterima Oleh
                                </label>
                                <input type="text" id="received_by" name="received_by"
                                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:border-primary focus:outline-primary focus:ring-primary dark:text-white">
                                @error('received_by')
                                    <div class="text-red-500 text-xs">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit"
                                class="text-white bg-primary focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary dark:hover:bg-primary dark:focus:ring-primary">Tambahkan
                                Data</button>
                        </div>
                    </form>
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
@endsection
