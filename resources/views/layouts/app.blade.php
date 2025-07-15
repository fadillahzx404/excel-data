<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <title>@yield('title')</title>



    {{-- Style --}}
    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')


</head>

<body class="antialiased relative bg-gray-100 ">

    <div class="flex flex-row">

        <div class="drawer lg:drawer-open">
            <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content flex flex-col">
                <!-- Page content here -->
                <div class="grid">



                    {{-- Navbar --}}
                    @include('includes.navigation_dashboard')

                    {{-- Page Content --}}
                    @yield('page-content')

                    {{-- Footer --}}

                    @include('includes.footer')


                </div>

            </div>

            <div class="drawer-side shadow-md">
                <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>

                <div class="menu px-4 w-80 bg-white text-base-content min-h-screen" style="scroll-top: 0">
                    <!-- Sidebar content here -->
                    <div class="logo rounded-full grid justify-center py-5">
                        <a href="{{ route('dashboard') }}" class="transition duration-300 hover:scale-90 ">
                            <x-card-logo />
                        </a>

                    </div>

                    <p class="font-bold py-2 px-2 mb-2">Menu</p>

                    @include('includes.sidebar')

                </div>


            </div>
        </div>

    </div>


    {{-- Script --}}
    @stack('prepend-script')
    @include('includes.script')
    @stack('addon-script')

</body>

</html>
