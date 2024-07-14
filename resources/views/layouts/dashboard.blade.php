<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/styles/main.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />


    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    @include('sweetalert::alert')
    <main class="w-full h-screen">
        <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200  ">
            <div class="px-3 py-3 lg:px-5 lg:pl-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-start rtl:justify-end">
                        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                            aria-controls="logo-sidebar" type="button"
                            class="inline-flex items-center p-2 text-sm text-primary rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200   ">
                            <span class="sr-only">Open sidebar</span>
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                                </path>
                            </svg>
                        </button>
                        <a href="/" class="flex ms-2 gap-3 md:me-24 items-center">
                            <img src="{{ asset('assets/images/logo-nadia-collection.png') }}"
                                class="h-12 w-12 rounded-full" alt="">
                            <span
                                class="self-center text-xl text-primary font-semibold sm:text-2xl whitespace-nowrap ">Nadia
                                Collection</span>
                        </a>
                    </div>
                    <div class="flex items-center">
                        <div class="flex items-center ms-3">
                            <div>
                                <button type="button"
                                    class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 "
                                    aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="w-8 h-8 rounded-full"
                                        src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                                        alt="user photo">
                                </button>
                            </div>
                            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow "
                                id="dropdown-user">
                                <div class="px-4 py-3" role="none">
                                    <p class="text-sm text-gray-500 " role="none">
                                        {{ Auth::guard('admin')->user()->name }} •
                                        {{ Auth::guard('admin')->user()->role }}
                                    </p>
                                    <p class="text-sm font-medium text-gray-500 truncate " role="none">
                                        {{ Auth::guard('admin')->user()->email }}
                                    </p>
                                </div>
                                <ul class="py-1" role="none">
                                    <li>
                                        <a href="{{ route('admin.dashboard') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100   "
                                            role="menuitem">Dashboard</a>
                                    </li>

                                    <li>
                                        <form action="{{ route('admin.logout') }}" method="post">
                                            @csrf
                                            <button type="submit"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100   "
                                                role="menuitem">Sign out</button>
                                        </form>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <aside id="logo-sidebar"
            class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0  "
            aria-label="Sidebar">
            <div class="h-full px-3 pb-4 overflow-y-auto bg-white ">
                <ul class="space-y-2 font-medium">
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center p-2 text-gray-500 rounded-lg  hover:bg-gray-100  group">
                            <i
                                class='bx bxs-pie-chart-alt-2  w-5 h-5 text-primary transition duration-75    text-xl'></i>


                            <span class="ms-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.hasil-produksi') }}"
                            class="flex items-center p-2 text-gray-500 rounded-lg  hover:bg-gray-100  group">
                            <i
                                class='bx bx-shopping-bag flex-shrink-0 w-5 h-5 text-primary transition duration-75   text-xl '></i>

                            <span class="flex-1 ms-3 whitespace-nowrap">Hasil Produksi</span>

                        </a>
                    </li>
                    @if (Auth::guard('admin')->user()->role == 'Admin')
                        <li>
                            <a href="{{ route('admin.bahan-mentah') }}"
                                class="flex items-center p-2 text-gray-500 rounded-lg  hover:bg-gray-100  group ">
                                <i
                                    class='bx bxs-package flex-shrink-0 w-5 h-5 text-primary transition duration-75   text-xl '></i>

                                <span class="flex-1 ms-3 whitespace-nowrap">Bahan Mentah</span>

                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.supplier') }}"
                                class="flex items-center p-2 text-gray-500 rounded-lg  hover:bg-gray-100  group">
                                <i
                                    class='bx bxs-truck flex-shrink-0 w-5 h-5 text-primary transition duration-75   text-xl '></i>


                                <span class="flex-1 ms-3 whitespace-nowrap">Supplier</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.admins') }}"
                                class="flex items-center p-2 text-gray-500 rounded-lg  hover:bg-gray-100  group">
                                <i
                                    class='bx bx-user-circle flex-shrink-0 w-5 h-5 text-primary transition duration-75   text-xl '></i>

                                <span class="flex-1 ms-3 whitespace-nowrap">User</span>
                            </a>
                        </li>
                    @endif


                </ul>
            </div>
        </aside>

        <div class="p-4" style="margin-top: 50px !important; padding: 10vh; margin-left: 28vh;">
            @yield('content')
        </div>

    </main>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

    <script>
        AOS.init();
    </script>
</body>

</html>
