@extends('layouts.app')
@section('title')
    User Edit
@endsection
@section('page-content')
    <div class="container px-12 pb-36 pt-12 lg:mt-8 max-lg:px-10 max-sm:px-5 mx-auto min-h-screen">

        <section class="user-created card card-compact bg-white shadow-xl rounded-md">
            <div class="card-body">
                <div class="grid title gap-2">
                    <p class="text-lg font-medium">Edit User</p>
                    <hr class="mb-3 border-gray-300" />
                </div>
                <form action="{{ route('user-settings.update', $data->id) }}" method="POST" class="grid gap-3"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">

                        <div class="grid grid-cols-2 max-sm:grid-cols-1 gap-5">
                            <div class="flex flex-col">
                                <label for="result-foto" class="text-center">Upload your foto <span
                                        class="text-sm text-red-400"> (Optional).</span></label>
                                <p class=" text-xs text-center text-gray-400 dark:text-red-600">If you doesn't wanna use a
                                    photo profile don't upload a photo.</p>
                                <div class="flex items-center justify-center w-full mt-3">

                                    <label for="imgInp"
                                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                    class="font-semibold">Click to upload</span> or drag and drop</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG or JPEG</p>
                                        </div>
                                        <input id="imgInp" type="file" class="hidden" name="profile_photo_path" />
                                    </label>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <label for="foto-label" class="text-center mb-3">Result foto</label>
                                <div class="w-full h-full grid">

                                    <img src="{{ asset('storage/' . $data->profile_photo_path) }}"
                                        class="resultfoto w-48 h-48 rounded-full border border-gray-300 shadow-lg place-self-center object-center object-contain"
                                        id="resultfoto" alt="">

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="grid grid-cols-2 gap-5">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Email</span>
                            </label>
                            <input type="email" name="email" value="{{ $data->email }}"
                                class="input input-bordered input-neutral w-full focus:outline-offset-0 focus:border-neutral" />
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Password</span>
                            </label>
                            <div class="relative">
                                <input type="password" name="password" id="pass-input"
                                    class="input input-bordered input-neutral w-full focus:outline-offset-0 focus:border-neutral" />
                                <button id="btn-eye" type="button"
                                    class="btn btn-ghost hover:bg-neutral absolute right-0 text-gray-800 hover:text-white">
                                    <svg class="w-4 h-4 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                                        <path
                                            d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                                    </svg>
                                </button>

                            </div>
                            <label for="">
                                <span class="label-text text-red-600">*Password sebelumnya tidak bisa dilihat, jagan
                                    dimasukan jika tidak ingin di ubah.</span>
                            </label>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-5">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Name</span>
                            </label>
                            <input type="text" name="name" value="{{ $data->name }}"
                                class="input input-bordered input-neutral w-full focus:outline-offset-0 focus:border-neutral" />
                        </div>
                        <div class="form-control">
                            <label class="label">Pilih
                                Roles</label>
                            <select id="countries" name="roles"
                                class="select select-bordered w-full  focus:outline-offset-0 focus:border-neutral font-medium">

                                <option value="ADMIN" @if ($data->roles == 'ADMIN') selected @endif>ADMIN
                                </option>
                                <option value="DESIGNER" @if ($data->roles == 'DESIGNER') selected @endif>DESIGNER</option>
                                <option value="OPERATOR" @if ($data->roles == 'OPERATOR') selected @endif>OPERATOR</option>


                            </select>
                        </div>
                    </div>



                    <div class="flex flex-row gap-2 mt-10 justify-end">
                        <a href="{{ route('user-settings.index') }}"
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
    <script type='text/javascript'>
        $('#btn-eye').click(function() {
            if ('password' == $('#pass-input').attr('type')) {
                $('#pass-input').prop('type', 'text');
            } else {
                $('#pass-input').prop('type', 'password');
            }
        });
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                resultfoto.src = URL.createObjectURL(file)
            }
        }
    </script>
@endpush
