@extends('layouts.app')
@section('title')
    Edit Data
@endsection
@section('page-content')
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
                    @if (!empty($data->dataDetails->ColoringCol) && !empty($data->dataDetails->ColoringRow))
                        <div class="form-control title-table">
                            <label class="label grid">
                                <span class="text-lg font-medium">Keterangan.</span>
                                <p class="pb-2 text-md">Kolom Terakhir Di Ubah Oleh:</p>

                                @foreach ($data->dataDetails->ColoringCol->take(3) as $item)
                                    <p class="pl-2"><b
                                            class="uppercase">{{ $item->userProfile->name == Auth::user()->name ? 'ANDA' : $item->userProfile->name }}</b>
                                        ({{ $item->userProfile->roles }})
                                        Telah Mengubah Warna Kolom <b>{{ $item->header }}</b>.</p>
                                @endforeach

                                <p class="py-2 text-md">Baris Terakhir Di Ubah Oleh:</p>

                                @foreach ($data->dataDetails->ColoringRow->take(3) as $item)
                                    <p class="pl-2"><b
                                            class="uppercase">{{ $item->userProfile->name == Auth::user()->name ? 'ANDA' : $item->userProfile->name }}</b>
                                        ({{ $item->userProfile->roles }})
                                        Telah Mengubah Warna Baris <b>{{ $item->index_row + 1 }}</b>.</p>
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

                            @if ($data->dataDetails->ColoringRow->where('user_id', Auth::user()->id)->isEmpty())
                                <label for="my_modal_3" class="btn btn-sm btn-neutral">Ubah Warna Baris</label>
                            @else
                                <label for="my_modal_4" class="btn btn-sm btn-error">Hapus Warna Baris</label>
                            @endif
                        @elseif (Auth::user()->roles == 'ADMIN')
                            <label for="my_modal_1" class="btn btn-sm btn-neutral">Ubah Warna Kolom</label>

                            <label for="my_modal_5" class="btn btn-sm btn-error">Hapus Warna Kolom</label>


                            <label for="my_modal_3" class="btn btn-sm btn-neutral">Ubah Warna Baris</label>

                            <label for="my_modal_6" class="btn btn-sm btn-error">Hapus Warna Baris</label>
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
                <h3 class="font-bold text-lg">Pilih Kolom dan Pilih Warna!</h3>
                <form action="{{ route('datas-update-col') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-3 gap-2">
                        <label class="form-control w-full col-span-2">
                            <div class="label">
                                <span class="label-text">Pilih Kolom</span>

                            </div>
                            <select class="select select-bordered" name="header">
                                @foreach (json_decode($data->dataDetails->header_table) as $head)
                                    <option value="{{ $head }}">{{ $head }}</option>
                                @endforeach
                            </select>

                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Pilih Warna</span>

                            </div>
                            <input type="color" class="input input-bordered w-full" name="color_col" />

                        </label>
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

        <!-- Modal 2 -->
        @if ($data->dataDetails->ColoringCol->where('user_id', Auth::user()->id)->isEmpty())
        @else
            <input type="checkbox" id="my_modal_2" class="modal-toggle" />

            <div class="modal" role="dialog">
                <div class="modal-box">


                    <h3 class="font-bold text-lg">Apakah anda yakin!</h3>
                    <p class="py-4">Yakin ingin menghapus warna kolom yang telah anda berikan?</p>
                    <div class="modal-action">
                        <label for="my_modal_2" class="btn btn-sm btn-warning">Kembali</label>
                        <?php
                        foreach ($data->dataDetails->ColoringCol->where('user_id') as $userCol) {
                            $idCol = $userCol->id;
                        }
                        ?>

                        <form action="{{ route('datas-delete-col', ['id' => $idCol, 'datas_id' => $data->id]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-error">Ya, Hapus !</button>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        <!-- Modal 3 -->

        <input type="checkbox" id="my_modal_3" class="modal-toggle" />

        <div class="modal" role="dialog">
            <div class="modal-box">
                <h3 class="font-bold text-lg">Pilih Baris dan Pilih Warna!</h3>
                <form action="{{ route('datas-update-row') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-3 gap-2">
                        <label class="form-control w-full col-span-2">
                            <div class="label">
                                <span class="label-text">Pilih Baris</span>

                            </div>

                            <select class="select select-bordered" id="indexSelected" name="index_row">
                                @for ($i = 0; $i < count(json_decode($data->dataDetails->value_table)); $i++)
                                    <option value="{{ $i }}">{{ $i + 1 }}</option>
                                @endfor
                            </select>

                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="data_details_id" value="{{ $data->dataDetails->id }}">
                            <input type="hidden" name="datas_id" value="{{ $data->id }}">


                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Pilih Warna</span>

                            </div>
                            <input type="color" class="input input-bordered w-full" name="color_row" />

                        </label>
                    </div>
                    <div class="modal-action">
                        <label for="my_modal_3" class="btn btn-sm btn-warning">Cancel</label>
                        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        @if ($data->dataDetails->ColoringRow->where('user_id', Auth::user()->id)->isEmpty())
        @else
            <!-- Modal 4 -->

            <input type="checkbox" id="my_modal_4" class="modal-toggle" />

            <div class="modal" role="dialog">
                <div class="modal-box">


                    <h3 class="font-bold text-lg">Apakah anda yakin!</h3>
                    <p class="py-4">Yakin ingin menghapus warna baris yang telah anda berikan?</p>
                    <div class="modal-action">
                        <label for="my_modal_4" class="btn btn-sm btn-warning">Kembali</label>
                        @php
                            foreach ($data->dataDetails->ColoringRow->where('user_id') as $userRow) {
                                $idRow = $userRow->id;
                            }
                        @endphp


                        <form action="{{ route('datas-delete-row', ['id' => $idRow, 'datas_id' => $data->id]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-error">Ya, Hapus !</button>
                        </form>
                    </div>
                </div>
            </div>
        @endif


        @if ($data->dataDetails->ColoringCol->isEmpty())
        @else
            <!-- Modal 5 -->
            <input type="checkbox" id="my_modal_5" class="modal-toggle" />

            <div class="modal" role="dialog">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">Hapus Kolom!</h3>
                    <form action="{{ route('datas-delete-col', ['datas_id' => $data->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <p class="pt-4">Pilih kolom yang anda ingin hapus warnanya?</p>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Pilih Kolom</span>

                            </div>
                            <select class="select select-bordered" name="id">
                                @foreach ($data->dataDetails->ColoringCol as $head)
                                    <option value="{{ $head->id }}">{{ $head->header }}</option>
                                @endforeach
                            </select>

                        </label>
                        <div class="modal-action">
                            <label for="my_modal_5" class="btn btn-sm btn-warning">Kembali</label>

                            <button type="submit" class="btn btn-sm btn-error">Ya, Hapus !</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        @if ($data->dataDetails->coloringRow->isEmpty())
        @else
            <!-- Modal 6 -->
            <input type="checkbox" id="my_modal_6" class="modal-toggle" />

            <div class="modal" role="dialog">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">Hapus Kolom!</h3>
                    <form action="{{ route('datas-delete-row', ['datas_id' => $data->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <p class="pt-4">Pilih baris yang anda ingin hapus warnanya?</p>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Pilih Baris</span>

                            </div>


                            <select class="select select-bordered" name="id">
                                @foreach ($data->dataDetails->ColoringRow->sortBy('index_row') as $keey)
                                    <option value="{{ $keey->id }}">{{ $keey->index_row + 1 }}</option>
                                @endforeach

                            </select>

                        </label>
                        <div class="modal-action">
                            <label for="my_modal_6" class="btn btn-sm btn-warning">Kembali</label>

                            <button type="submit" class="btn btn-sm btn-error">Ya, Hapus !</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif


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
        window.ColoringRowing = {
            coloringRow: <?php echo json_encode($data->dataDetails->ColoringRow); ?>
        }
    </script>
@endpush
