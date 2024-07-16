@extends('admin.layouts.main', [
    'title' => 'Manajemen Data Barang CV Fajar Teknika',
    'active' => 'Barang',
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
                            Rekapitulasi &middot; Data Barang Persediaan
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
                <div class="w-1/2 text-center py-8">
                    <div class="border-r">
                        <div class="text-grey-darker mb-2">
                            <span class="text-5xl">{{ $totalBarang }}</span>
                        </div>
                        <div class="text-sm uppercase text-grey tracking-wide">
                            Total Jenis Barang
                        </div>
                    </div>
                </div>
                <div class="w-1/2 text-center py-8">
                    <div class="border-r">
                        <div class="text-grey-darker mb-2">
                            <span class="text-5xl">{{ $totalStok }}</span>
                        </div>
                        <div class="text-sm uppercase text-grey tracking-wide">
                            Total Stok Barang
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
                                <i class='bx bxl-dropbox text-3xl'></i>Data
                                Barang CV
                                Fajar Teknika
                            </h3>
                            <div class="flex">

                                <button type="button" data-modal-target="add-barang-modal"
                                    data-modal-toggle="add-barang-modal"
                                    class="appearance-none py-2 px-3 duration-700 hover:bg-primary text-primary hover:text-white border rounded-lg border-primary hover:border-grey-dark ">
                                    Tambah Data Barang
                                </button>
                            </div>
                        </div>
                    </div>
                    <table class="w-full text-sm text-left  rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs  text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 font-medium text-sm">No</th>
                                <th scope="col" class="px-6 py-3 font-medium text-sm">Nama Barang</th>
                                <th scope="col" class="px-6 py-3 font-medium text-sm">Kode Barang</th>
                                <th scope="col" class="px-6 py-3 font-medium text-sm">Harga Barang</th>
                                <th scope="col" class="px-6 py-3 font-medium text-sm">Stok Barang</th>
                                <th scope="col" class="px-6 py-3 font-medium text-sm">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-800">
                            @foreach ($barangs as $index => $barang)
                                <tr class="transition-all hover:bg-[#f9f9f9]">
                                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4">{{ $barang->nama_barang }}</td>
                                    <td class="px-6 py-4">{{ $barang->kode_barang }}</td>
                                    <td class="px-6 py-4">{{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">{{ $barang->stok_barang }}</td>
                                    <td class="px-6 py-4 flex gap-2">
                                        <button data-modal-target="edit-produksi-modal-{{ $barang->id }}"
                                            data-modal-toggle="edit-produksi-modal-{{ $barang->id }}"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                            <i class='bx bx-edit'></i>Edit
                                        </button>
                                        <form action="{{ route('admin.barang.destroy') }}" method="POST"
                                            onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" value="{{ $barang->id }}" name="id">
                                            <button type="submit"
                                                class="font-medium text-red-600 dark:text-red-500 text-sm hover:underline">
                                                <i class='bx bx-trash-alt'></i>Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal for Editing Produksi -->
                                <div id="edit-produksi-modal-{{ $barang->id }}" tabindex="-1" aria-hidden="true"
                                    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative w-full max-w-lg max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <div
                                                class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Edit Data Barang
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-hide="edit-produksi-modal-{{ $barang->id }}">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 111.414 1.414L11.414 10l4.293 4.293a1 1 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="p-6 space-y-0">
                                                <form action="{{ route('admin.barang.update') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" value="{{ $barang->id }}" name="id">
                                                    <div class="flex gap-2 w-full">
                                                        <div class="mb-4 w-full">
                                                            <label for="kode_barang_{{ $barang->id }}"
                                                                class="block mb-2 font-medium text-gray-500 dark:text-white text-sm">Kode
                                                                Barang
                                                            </label>
                                                            <input type="text" id="kode_barang_{{ $barang->id }}"
                                                                name="kode_barang"
                                                                class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:border-primary focus:outline-primary focus:ring-primary dark:text-white"
                                                                value="{{ $barang->kode_barang }}">
                                                            @error('kode_barang')
                                                                <div class="text-red-500 text-xs">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-4 w-full">
                                                            <label for="nama_barang_{{ $barang->id }}"
                                                                class="block mb-2 font-medium text-gray-500 dark:text-white text-sm">Nama
                                                                Barang
                                                            </label>
                                                            <input type="text" id="nama_barang_{{ $barang->id }}"
                                                                name="nama_barang"
                                                                class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:border-primary focus:outline-primary focus:ring-primary dark:text-white"
                                                                value="{{ $barang->nama_barang }}">
                                                            @error('nama_barang')
                                                                <div class="text-red-500 text-xs">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="flex gap-2 w-full">
                                                        <div class="mb-4 w-full">
                                                            <label for="harga_jual_{{ $barang->id }}"
                                                                class="block mb-2 font-medium text-gray-500 dark:text-white text-sm">Harga
                                                                Jual
                                                            </label>
                                                            <input type="number" id="harga_jual_{{ $barang->id }}"
                                                                name="harga_jual"
                                                                class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:border-primary focus:outline-primary focus:ring-primary dark:text-white"
                                                                value="{{ $barang->harga_jual }}">
                                                            @error('harga_jual')
                                                                <div class="text-red-500 text-xs">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-4 w-full">
                                                            <label for="stok_barang_{{ $barang->id }}"
                                                                class="block mb-2 font-medium text-gray-500 dark:text-white text-sm">Stok
                                                                Barang
                                                            </label>
                                                            <input type="number" id="stok_barang_{{ $barang->id }}"
                                                                name="stok_barang"
                                                                class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:border-primary focus:outline-primary focus:ring-primary dark:text-white"
                                                                value="{{ $barang->stok_barang }}">
                                                            @error('stok_barang')
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


    <div id="add-barang-modal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-lg max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Tambah Data Barang
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="add-barang-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-6 space-y-6">
                    <form action="{{ route('admin.barang.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="flex gap-2 w-full">
                            <div class="mb-4 w-full">
                                <label for="kode_barang"
                                    class="block mb-2 font-medium text-gray-500 dark:text-white text-sm">Kode Barang
                                </label>
                                <input type="text" id="kode_barang" name="kode_barang"
                                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:border-primary focus:outline-primary focus:ring-primary dark:text-white">
                                @error('kode_barang')
                                    <div class="text-red-500 text-xs">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4 w-full">
                                <label for="nama_barang"
                                    class="block mb-2 font-medium text-gray-500 dark:text-white text-sm">Nama Barang
                                </label>
                                <input type="text" id="nama_barang" name="nama_barang"
                                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:border-primary focus:outline-primary focus:ring-primary dark:text-white">
                                @error('nama_barang')
                                    <div class="text-red-500 text-xs">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="flex gap-2 w-full">
                            <div class="mb-4 w-full">
                                <label for="harga_jual"
                                    class="block mb-2 font-medium text-gray-500 dark:text-white text-sm">Harga Jual
                                </label>
                                <input type="text" id="harga_jual" name="harga_jual"
                                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:border-primary focus:outline-primary focus:ring-primary dark:text-white">
                                @error('harga_jual')
                                    <div class="text-red-500 text-xs">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4 w-full">
                                <label for="stok_barang"
                                    class="block mb-2 font-medium text-gray-500 dark:text-white text-sm">Stok Barang
                                </label>
                                <input type="text" id="stok_barang" name="stok_barang"
                                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:border-primary focus:outline-primary focus:ring-primary dark:text-white">
                                @error('stok_barang')
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
