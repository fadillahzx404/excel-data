@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('page-content')
    <div class="container px-12 lg:mt-8 max-lg:px-10 max-sm:px-5 mx-auto min-h-screen">

        <div class="text-center">
            <p class="pt-5 text-4xl font-black">Hello {{ Auth::user()->name }}</p>
            <p>Welcome On Dashboard</p>
        </div>

        @php

            // Hitung jumlah berdasarkan warna
            $processCount = collect($coloringDataCol)->where('color_col', '#00d390')->count();
            $successCount = collect($coloringDataCol)->where('color_col', '!=', '#00d390')->count();
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">

            {{-- Card Process --}}
            <div class="card bg-green-400 shadow-xl rounded-lg p-6">
                <h2 class="text-white font-bold text-xl mb-3">Process</h2>
                <p class="text-white text-3xl">{{ $processCount }}</p>
                <p class="text-white mt-2">Jumlah data berstatus Process </p>
            </div>

            {{-- Card Success --}}
            <div class="card bg-blue-700 shadow-xl rounded-lg p-6">
                <h2 class="text-white font-bold text-xl mb-3">Success</h2>
                <p class="text-white text-3xl">{{ $successCount }}</p>
                <p class="text-white mt-2">Jumlah data berstatus Success</p>
            </div>

        </div>
    </div>
@endsection
