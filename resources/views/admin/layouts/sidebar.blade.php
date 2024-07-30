<style>   
    .nav-treeview > .nav-item > .nav-link.active,
    .nav-treeview > .nav-item > .nav-link.active:hover {
        background-color: rgba(148, 163, 184, 0.9);
        color: #343a40;
        border-radius: 5px;
    }
</style>
<aside class="main-sidebar bg-slate-300 elevation-4">
    <div class="sidebar">
        <!-- User Panel -->
        <div class="user-panel mt-3 pb-1 mb-1 d-flex">
            <div class="image">
                <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="Admin Image">
            </div>
            <div class="info bg-gray-100 py-1 px-2 ml-2 rounded-lg shadow-md">
                <a href="{{ route('admin.dashboard') }}" class="block text-slate-500 hover:text-blue-800 font-semibold text-md">
                    {{ Auth::user()->name }}
                </a>
            </div>
        </div>

        <!-- Divider -->
        <hr class="bg-black">

        <!-- Navigation -->
        <nav class="mt-2">
            <ul class="nav nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item {{ request()->routeIs('admin.users.*') || request()->routeIs('admin.festivals.*') || request()->routeIs('admin.plans.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link text-black parent-menu {{ request()->routeIs('admin.users.*') || request()->routeIs('admin.festivals.*') || request()->routeIs('admin.plans.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Manage
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                                <i class="fa fa-user text-black" aria-hidden="true"></i>
                                <p class="text-black">Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.festivals.index') }}" class="nav-link {{ request()->routeIs('admin.festivals.*') ? 'active' : '' }}">
                                <i class="fa fa-gift text-black" aria-hidden="true"></i>
                                <p class="text-black">Festivals</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.plans.index') }}" class="nav-link {{ request()->routeIs('admin.plans.*') ? 'active' : '' }}">
                                <i class="fa fa-calendar text-black" aria-hidden="true"></i>
                                <p class="text-black">Plans</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>


