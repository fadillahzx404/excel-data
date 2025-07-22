@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-content')
    <div class="container px-12 lg:mt-8 max-lg:px-10 max-sm:px-5 mx-auto min-h-screen">

        <div class="text-center mb-10">
            <p class="pt-5 text-4xl font-black">Hello, {{ Auth::user()->name }}</p>
            <p class="text-gray-600">Welcome On Dashboard</p>
        </div>



        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">

            {{-- Process --}}
            <div class="card bg-green-400 shadow-xl rounded-lg p-6 flex flex-col justify-center items-center">
                <h2 class="text-white font-bold text-xl mb-3">Process</h2>
                <p class="text-white text-4xl font-semibold">{{ $processCount }}</p>
                <p class="text-white mt-2 text-center">Jumlah data berstatus Process</p>
            </div>

            {{-- Success --}}
            <div class="card bg-blue-700 shadow-xl rounded-lg p-6 flex flex-col justify-center items-center">
                <h2 class="text-white font-bold text-xl mb-3">Success</h2>
                <p class="text-white text-4xl font-semibold">{{ $successCount }}</p>
                <p class="text-white mt-2 text-center">Jumlah data berstatus Success</p>
            </div>

            {{-- Total Warnai --}}
            {{-- <div class="card bg-gray-800 shadow-xl rounded-lg p-6 flex flex-col justify-center items-center">
                <h2 class="text-white font-bold text-xl mb-3">Total Warnai</h2>
                <p class="text-white text-4xl font-semibold">{{ $totalColored }}</p>
                <p class="text-white mt-2 text-center">Total data yang diwarnai</p>
            </div> --}}

            {{-- Belum Diwarnai --}}
            <div class="card bg-grey shadow-xl rounded-lg p-6 flex flex-col justify-center items-center">
                <h2 class="text-black font-bold text-xl mb-3">Belum Diwarnai</h2>
                <p class="text-black text-4xl font-semibold">{{ $uncoloredCount }}</p>
                <p class="text-black mt-2 text-center">Data yang belum diwarnai</p>
            </div>

        </div>


    </div>
@endsection
