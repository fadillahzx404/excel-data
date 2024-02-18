@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('page-content')
    <div class="container px-12 lg:mt-8 max-lg:px-10 max-sm:px-5 mx-auto min-h-screen">
        <div class="text-center">
            <p class="pt-5 text-4xl font-black">Hello {{ Auth::user()->name }}</p>
            <p>Wellcome On Dashboard</p>
        </div>



    </div>
@endsection
