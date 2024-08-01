<style>
    .bg-white .nav-treeview>.nav-item>.nav-link.active,
    .bg-white .nav-treeview>.nav-item>.nav-link.active:hover {
        background-color: rgba(148, 163, 184, 0.9);
        color: #343a40;
        border-radius: 5px;
    }
</style>
<aside class="main-sidebar bg-slate-300	 elevation-2">
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
            <ul class="nav nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li
                    class="nav-item {{ request()->routeIs('festivals.*') || request()->routeIs('clients.*') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link text-black parent-menu {{ request()->routeIs('festivals.*') || request()->routeIs('clients.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Manage
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('festivals.index') }}"
                                class="nav-link {{ request()->routeIs('festivals.*') ? 'active' : '' }}">
                                <i class="fa fa-gift text-black" aria-hidden="true"></i>
                                <p class="text-black">Festivals</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('clients.index') }}"
                                class="nav-link {{ request()->routeIs('clients.*') ? 'active' : '' }}">
                                <i class="fa fa-list-alt text-black" aria-hidden="true"></i>
                                <p class="text-black">Clients</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
