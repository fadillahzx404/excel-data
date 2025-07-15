<div class="container px-8 max-lg:px-0 sticky lg:top-3  z-40">
    <div class="navbar bg-white sticky lg:rounded-lg lg:border-1  top-0 z-40 shadow-md">
        <div class="flex flex-row grow justify-between">

            <div class="flex-none ">
                <div class="time px-8 font-bold">{{ date('d/m/Y') }}</div>
            </div>


            <div class="flex space-x-3 lg:px-8">
                <div class="dropdown dropdown-end {{ Auth::user()->roles !== 'USER' ? 'hidden' : '' }}">
                </div>



                <div class="grid">
                    <p class="">Hello, <b>{{ Auth::user()->name }}</b></p>
                    <p class="text-xs font-light text-end">{{ Auth::user()->roles }}</p>
                </div>

                <div class="border border-grey-900 "></div>
                <div class="dropdown dropdown-end ">
                    <label tabindex="0"
                        class="btn btn-ghost btn-circle avatar transition duration-300 hover:scale-90">
                        <div class="w-9 rounded-full">
                            @if (Auth::user()->profile_photo_path !== null)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="">
                            @else
                                <svg class=" text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                                </svg>
                            @endif

                        </div>
                    </label>
                    <ul tabindex="0"
                        class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-40">
                        <li>
                            <a href="{{ route('dashboard') }}" class="hover:bg-gray-800 hover:text-white">
                                Dashboard
                            </a>
                        </li>
                        <li><a href="{{ route('user-settings.edit', Auth::user()->id) }}"
                                class="hover:bg-gray-800 hover:text-white">
                                {{ __('Profile') }}
                            </a>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}"
                                class="hover:bg-gray-800 hover:text-white">
                                @csrf

                                <a :href="route('logout')"
                                    onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                    Log out
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
