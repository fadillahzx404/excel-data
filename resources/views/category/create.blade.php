@extends('layouts.app')
@section('title')
    Tambah Category
@endsection
@section('page-content')
    <div class="container px-12 pb-36 pt-12 lg:mt-8 max-lg:px-10 max-sm:px-5 mx-auto min-h-screen">

        <section class="user-created card card-compact bg-white shadow-xl rounded-md">
            <div class="card-body">
                <div class="grid title gap-2">
                    <p class="text-lg font-medium">Tambah Category Data</p>
                    <hr class="mb-3 border-gray-300" />
                </div>
                <form action="{{ route('category.store') }}" method="POST" class="grid gap-3" enctype="multipart/form-data">
                    @csrf


                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Nama Category Data</span>
                            </label>
                            <input type="text" name="name_category"
                                class="input input-bordered input-neutral w-full focus:outline-offset-0 focus:border-neutral" />
                        </div>




                    <div class="flex flex-row gap-2 mt-10 justify-end">
                        <a href="{{ route('category.index') }}"
                            class="btn btn-sm btn-error transition duration-300 hover:scale-90">Cancel</a>
                        <button class="btn btn-sm px-5 btn-success text-white transition duration-300 hover:scale-90"
                            type="submit">Next</button>


                    </div>

                </form>
            </div>
        </section>

    </div>
@endsection

