<ul class="min-h-full space-y-2 ">

    <li><a href="{{ route('dashboard') }}"
            class=" hover:bg-gray-600 transition duration-300 hover:scale-90 mx-2 {{ request()->is('dashboard*') ? 'bg-gray-900 text-white  font-semibold' : 'text-gray-400' }}"><i
                class="fa-solid fa-house"></i>Dashboard</a>
    </li>
    @if (Auth::user()->roles == 'ADMIN')
        <li><a href="{{ route('category.index') }}"
                class=" hover:bg-gray-600  transition duration-300 hover:scale-90 mx-2 {{ request()->is('category*') ? 'bg-gray-900 text-white  font-semibold' : 'text-gray-400' }}"><i
                    class="fa-solid fa-list"></i>Category</a>
        </li>
    @endif
    <li><a href="{{ route('datas.index') }}"
            class=" hover:bg-gray-600  transition duration-300 hover:scale-90 mx-2 {{ request()->is('datas*') ? 'bg-gray-900 text-white  font-semibold' : 'text-gray-400' }}"><i
                class="fa-solid fa-file-pen"></i>Data</a>
    </li>
    @if (Auth::user()->roles == 'ADMIN')
        <li><a href="{{ route('user-settings.index') }}"
                class=" hover:bg-gray-800 transition duration-300 hover:scale-90 mx-2 {{ request()->is('user*') ? 'bg-gray-900 text-white  font-semibold' : 'text-gray-400' }}"><i
                    class="fa-solid fa-users"></i>User</a>
        </li>
    @endif
</ul>
