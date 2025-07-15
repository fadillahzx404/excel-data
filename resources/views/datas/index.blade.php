@extends('layouts.app')
@section('title')
    Categories Services
@endsection
@section('page-content')
    <div class="flash-data" data-flash="{!! \Session::get('Success') !!}"></div>
    <div class="container px-12 lg:mt-8 max-lg:px-10 max-sm:px-5 mx-auto min-h-screen">

        <div class="relative overflow-x-auto shadow-lg border bg-white border-gray-200 sm:rounded-lg p-5">
            <div class="title-table grid">
                <div class="flex justify-between">
                    <div class="grid place-content-center">
                        <p class="text-lg font-bold">Data</p>
                        <p class="text-sm font-light text-gray-400">Data on here, you available to added, edited or
                            deleted.
                        </p>
                    </div>
                    {{-- <a href="{{ route('datas.create') }}"
                        class="btn btn-sm btn-neutral text-white transition duration-300 hover:scale-90 my-3 hover:text-black hover:bg-gray-200">Add
                        Data</a> --}}
                    @if (Auth::user()->roles == 'ADMIN')
                        <!-- The button to open modal -->
                        <label for="my_modal_6" class="btn btn-sm btn-neutral">Add Data</label>

                        <!-- Put this part before </body> tag -->
                        <input type="checkbox" id="my_modal_6" class="modal-toggle" />
                        <div class="modal" role="dialog">
                            <form action="{{ route('datas-check') }}" method="GET">
                                <div class="modal-box">
                                    <h3 class="font-bold text-lg">Hello!</h3>

                                    <div class="form-control">
                                        <label class="label">
                                            <span class="label-text">Jumlah Header</span>
                                        </label>
                                        <input type="number" name="jumlah_title"
                                            class="input input-bordered input-neutral w-full focus:outline-offset-0 focus:border-neutral" />

                                    </div>
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="label-text">Jumlah Baris</span>
                                        </label>

                                        <input type="number" name="jumlah_baris"
                                            class="input input-bordered input-neutral w-full focus:outline-offset-0 focus:border-neutral" />
                                    </div>
                                    <div class="modal-action">
                                        <label for="my_modal_6" class="btn btn-sm btn-warning">Cancel</label>
                                        <button type="submit" class="btn btn-sm btn-success">Next</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif


                </div>

                <hr class="mb-3 mt-2 border-gray-400" />

            </div>
            <div class="pb-4  ">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" id="searchInput"
                        class="block p-2 pl-10 text-sm text-gray-900 border  border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-gray-900    focus:border-gray-900     "
                        placeholder="Search for items">
                </div>
            </div>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 datatable  display" id="datatable">
                <thead class="text-xs text-gray-700 uppercase bg-white dark:bg-blue-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="w-10 p-4 text-center" style="text-align:center;">
                            No
                        </th>
                        <th scope="col" class="p-4 text-center" style="text-align:center;">
                            Nama Data
                        </th>
                        <th scope="col" class="p-4 text-center" style="text-align:center;">
                            Category Data
                        </th>
                        <th scope="col" class="p-4 text-end" style="text-align:end;">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($datas as $data)
                        <tr class="border-2 ">
                            <td class="p-4 text-center ">
                                {{ $loop->iteration }}
                            </td>
                            <th scope="row" class="p-4 whitespace-nowrap text-center">
                                {{ $data->nama_data }}
                            </th>
                            <td scope="row" class="p-4 whitespace-nowrap  text-center">
                                {{ $data->categories->name_category }}
                            </td>

                            <td class="p-4 text-end">

                                <div class="dropdown dropdown-end ">
                                    <label tabindex="0"
                                        class="btn btn-sm inline-flex items-center  border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150 shadow-sm shadow-gray-400">Action
                                        <span><svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg></span></label>
                                    <ul tabindex="0"
                                        class="mt-1 dropdown-content z-[1] menu p-2 shadow bg-base-100 border rounded-box w-36">
                                        <li class=""><a href="{{ route('datas.edit', $data->id) }}"
                                                class="hover:bg-orange-400 hover:text-white"><span><i
                                                        class="fa-solid fa-pen-to-square"></i> Edit</a>


                                        </li>
                                        @if (Auth::user()->roles == 'ADMIN')
                                            <li>
                                                <form action="{{ route('datas.destroy', $data->id) }}"
                                                    class="hover:bg-red-500 hover:text-white" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"><i class="fa-solid fa-trash"></i>
                                                        Delete</button>
                                                </form>
                                            </li>
                                        @endif
                                    </ul>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
@endsection
