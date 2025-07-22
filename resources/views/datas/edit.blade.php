@extends('layouts.app')
@section('title')
    Edit Data
@endsection


@section('page-content')
    <style>
        input[type="radio"].radio-neutral:checked {
            background-color: #9ca3af;
            /* abu-abu */
            border-color: #9ca3af;
            color: #9ca3af;
        }

        input[type="radio"].radio-neutral:checked:hover,
        input[type="radio"].radio-neutral:checked:focus {
            background-color: #6b7280;
            /* abu-abu lebih gelap */
            border-color: #6b7280;
            color: #6b7280;
        }
    </style>
    <div class="flash-data" data-flash="{!! \Session::get('Success') !!}"></div>
    <div class="container px-12 pb-36 pt-12 lg:mt-8 max-lg:px-10 max-sm:px-5 mx-auto min-h-screen">

        <section class="user-created card card-compact bg-white shadow-xl rounded-md">
            <div class="card-body">
                <div class="grid title gap-2">
                    <p class="text-lg font-medium">Edit Data</p>
                    <hr class="mb-3 border-gray-300" />
                </div>
                <form action="{{ route('datas.update', $data->id) }}" method="POST" class="grid gap-3"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="grid grid-cols-2 space-x-4">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Nama Data</span>
                            </label>
                            <input type="text" name="nama_data" required value="{{ $data->nama_data }}"
                                @if (Auth::user()->roles !== 'ADMIN') disabled @endif
                                class="input input-bordered input-neutral w-full focus:outline-offset-0 focus:border-neutral " />
                        </div>

                        <label class="form-control">
                            <div class="label">
                                <span class="label-text">Category Data</span>

                            </div>
                            <select class="select select-bordered" name="category_id"
                                @if (Auth::user()->roles !== 'ADMIN') disabled @endif>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" @if ($cat->id == $data->category_id) selected @endif>
                                        {{ $cat->name_category }}</option>
                                @endforeach
                            </select>

                        </label>
                    </div>
                    @if (!empty($data->dataDetails->ColoringCol))
                        <div class="form-control title-table">
                            <label class="label grid">
                                <span class="text-lg font-medium">Keterangan.</span>
                                <p class="pb-2 text-md">Kolom Terakhir Di Ubah Oleh:</p>

                                @foreach ($data->dataDetails->ColoringCol->take(3) as $item)
                                    <p class="pl-2"><b
                                            class="uppercase">{{ $item->userProfile->name == Auth::user()->name ? 'ANDA' : $item->userProfile->name }}</b>
                                        ({{ $item->userProfile->roles }})
                                        Telah Mengubah Warna Kolom <b>{{ $item->header }}</b> Baris
                                        <b>{{ $item->column }}</b>.
                                    </p>
                                @endforeach



                            </label>
                        </div>
                    @endif
                    <div class="form-control title-table">
                        <label class="label grid">
                            <span class="text-lg font-medium">Table</span>
                            <p>Silakan pilih menu di bawah ini :</p>
                        </label>
                    </div>
                    <div class="flex gap-2">

                        @if (Auth::user()->roles !== 'ADMIN')
                            @if (Auth::user()->roles == 'DESIGNER')
                                @if ($data->dataDetails->ColoringCol->where('user_id', Auth::user()->id)->isEmpty())
                                    <label for="my_modal_1" class="btn btn-sm btn-neutral">Ubah Warna Kolom</label>
                                @else
                                    <label for="my_modal_2" class="btn btn-sm btn-error">Hapus Warna Kolom</label>
                                @endif
                            @endif

                            {{-- @if ($data->dataDetails->ColoringRow->where('user_id', Auth::user()->id)->isEmpty())
                                <label for="my_modal_3" class="btn btn-sm btn-neutral">Ubah Warna Baris</label>
                            @else
                                <label for="my_modal_4" class="btn btn-sm btn-error">Hapus Warna Baris</label>
                            @endif --}}
                        @elseif (Auth::user()->roles == 'ADMIN')
                            <label for="my_modal_1" class="btn  btn-neutral">Ubah Warna</label>

                            <div class="form-control w-72 ">
                                <input type="text" id="searchInput" placeholder="Cari dalam tabel..."
                                    class="input input-bordered w-full" />
                            </div>
                        @endif

                    </div>




                    <div id="editedTable" class="hot handsontable htRowHeaders htColumnHeaders">
                    </div>

                    <input type="hidden" id="handsontable-data" name="handsontable_data">

                    <div class="flex flex-row gap-2 mt-10 justify-end">
                        <a href="{{ route('datas.index') }}"
                            class="btn btn-sm btn-warning transition duration-300 hover:scale-90">Kembali</a>
                        @if (Auth::user()->roles == 'ADMIN')
                            <button class="btn btn-sm px-5 btn-success text-white transition duration-300 hover:scale-90"
                                type="submit">Simpan</button>
                        @endif

                    </div>


                </form>
            </div>
        </section>

        <!-- Modal 1 -->
        <input type="checkbox" id="my_modal_1" class="modal-toggle" />

        <div class="modal" role="dialog">
            <div class="modal-box">
                <h3 class="font-bold text-lg">Pilih Aksi!</h3>
                <form action="{{ route('datas-update-col') }}" method="POST">
                    @csrf

                    <div class="grid gap-4 pb-4">
                        <label class="form-control w-full ">
                            <div class="label">
                                <span class="label-text">Pilih Kolom dan Baris</span>

                            </div>
                            <select class="select select-bordered" name="cell">
                                @php
                                    $headers = json_decode($data->dataDetails->header_table);
                                    $rows = count(json_decode($data->dataDetails->value_table));
                                @endphp

                                @foreach ($headers as $colIndex => $header)
                                    @for ($rowIndex = 1; $rowIndex <= $rows; $rowIndex++)
                                        <option value="{{ $header }},{{ $rowIndex }}">
                                            {{ $header }} - {{ $rowIndex }}</option>
                                    @endfor
                                @endforeach
                            </select>


                        </label>
                        <div class="flex justify-between px-3">
                            <div class="flex justify-center gap-2">
                                <input type="radio" name="radio" value="success" class="radio radio-primary" />
                                <span>Success</span>
                            </div>
                            <div class="flex justify-center gap-2">
                                <input type="radio" name="radio" value="process" class="radio radio-success" />
                                <span>Process</span>
                            </div>
                            <div class="flex justify-center gap-2">
                                <input type="radio" name="radio" value="notProcess" class="radio radio-neutral" />
                                <span>Not-Process</span>
                            </div>


                        </div>

                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="data_details_id" value="{{ $data->dataDetails->id }}">
                        <input type="hidden" name="datas_id" value="{{ $data->id }}">
                    </div>
                    <div class="modal-action">
                        <label for="my_modal_1" class="btn btn-sm btn-warning">Cancel</label>
                        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>



    </div>
@endsection


@push('addon-script')
    <script type="text/javascript">
        window.Laravel = {
            headerTable: <?php echo json_encode(json_decode($data->dataDetails->header_table)); ?>
        };
        window.Datas = {
            valueTable: <?php echo json_encode(json_decode($data->dataDetails->value_table)); ?>
        }
        window.Roles = {
            roles: <?php echo json_encode(Auth::user()->roles); ?>
        }
        window.ColoringColumn = {
            coloringCol: <?php echo json_encode($data->dataDetails->ColoringCol); ?>
        }
        // window.ColumnIndex = {
        //     columnIndex: <?php echo json_encode($data->dataDetails->ColoringRow); ?>
        // }
    </script>
@endpush
