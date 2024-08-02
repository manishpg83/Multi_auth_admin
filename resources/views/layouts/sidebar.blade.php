<aside class="main-sidebar bg-slate-50 elevation-2">
    <div class="sidebar">
        <div class="user-panel mt-3 pb-1 mb-1 d-flex">
            <div class="image">
                <img src="{{ Auth::user()->logo ? asset('public/storage/' . Auth::user()->logo) : asset('download.png') }}"
                    class="img-circle" alt="User Image">
            </div>
            <div class="info bg-gray-200 py-0.5 px-2 ml-2 rounded-lg shadow-md">
                <a href="{{ route('profile.edit') }}"
                    class="block text-slate-500 hover:text-blue-800 font-semibold text-md mt-0.5">
                    {{ Auth::user()->first_name }}
                </a>
            </div>
        </div>
        <hr class="bg-black">
        <nav class="mt-2">
            <ul class="nav nav-sidebar flex flex-col">
                <!-- Festivals Link -->
                <li class="nav-item">
                    <a href="{{ route('festivals.index') }}"
                        class="nav-link flex items-center p-2 rounded-md {{ request()->routeIs('festivals.*') ? 'bg-blue-400 text-white' : 'text-black hover:bg-blue-100' }}">
                        <i class="fa fa-gift {{ request()->routeIs('festivals.*') ? 'text-white' : 'text-black' }} mr-2"></i>
                        <p>Festivals</p>
                    </a>
                </li>
                
                <!-- Clients Link -->
                <li class="nav-item">
                    <a href="{{ route('clients.index') }}"
                        class="nav-link flex items-center p-2 rounded-md {{ request()->routeIs('clients.*') ? 'bg-blue-400 text-white' : 'text-black hover:bg-blue-100' }}">
                        <i class="fa fa-list-alt {{ request()->routeIs('clients.*') ? 'text-white' : 'text-black' }} mr-2"></i>
                        <p>Clients</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
