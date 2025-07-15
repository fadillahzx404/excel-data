@extends('layouts.app')
@section('title')
    Add Categories Services
@endsection
@section('page-content')
    <div class="container px-12 pb-36 pt-12 lg:mt-8 max-lg:px-10 max-sm:px-5 mx-auto min-h-screen">

        <section class="user-created card card-compact bg-white shadow-xl rounded-md">
            <div class="card-body">
                <div class="grid title gap-2">
                    <p class="text-lg font-medium">Add Categories Services</p>
                    <hr class="mb-3 border-gray-300" />
                </div>
                <form action="{{ route('datas.store') }}" method="POST" class="grid gap-3" enctype="multipart/form-data">
                    @csrf



                    <div class="grid grid-cols-2 space-x-4">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Nama Data</span>
                            </label>
                            <input type="text" name="nama_data" required
                                class="input input-bordered input-neutral w-full focus:outline-offset-0 focus:border-neutral" />
                        </div>

                        <label class="form-control">
                            <div class="label">
                                <span class="label-text">Category Data</span>

                            </div>
                            <select class="select select-bordered" name="category_id">
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name_category }}</option>
                                @endforeach
                            </select>

                        </label>
                    </div>
                    <div class="form-control title-table">
                        <label class="label grid">
                            <span class="text-lg font-medium">Edit Model Table</span>
                            <p>Silakan Klik Kanan untuk menambahkan atau menghapus baris ataupun kolom.</p>
                        </label>
                    </div>



                    <div id="example" class="hot handsontable htRowHeaders htColumnHeaders">
                    </div>



                    <input type="hidden" id="handsontable-data" name="handsontable_data">

                    <div class="flex flex-row gap-2 mt-10 justify-end">
                        <a href="{{ route('datas.index') }}"
                            class="btn btn-sm btn-error transition duration-300 hover:scale-90">Cancel</a>


                        <button class="btn btn-sm px-5 btn-success text-white transition duration-300 hover:scale-90"
                            type="submit">Save</button>


                    </div>

                </form>
            </div>
        </section>



    </div>
@endsection

@push('addon-script')
    <script type="text/javascript">
        window.Laravel = {
            nameHeader: <?php echo json_encode($header); ?>,
        };
    </script>
@endpush
