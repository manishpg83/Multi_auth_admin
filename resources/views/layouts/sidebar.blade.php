<style>
    .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active.parent-menu {
        background-color: transparent !important;
        color: #c2c7d0 !important;
    }
    
    .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active.parent-menu:hover {
        background-color: rgba(255,255,255,.1) !important;
    }
    
    .sidebar-dark-primary .nav-treeview > .nav-item > .nav-link.active,
    .sidebar-dark-primary .nav-treeview > .nav-item > .nav-link.active:hover {
        background-color: rgba(255,255,255,.9);
        color: #343a40;
    }
</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ Auth::user()->logo ? asset('storage/' . Auth::user()->logo) : asset('download.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('profile.edit') }}" class="d-block">{{ Auth::user()->first_name }}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item {{ request()->routeIs('festivals.*') || request()->routeIs('clients.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link parent-menu {{ request()->routeIs('festivals.*') || request()->routeIs('clients.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Manage
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('festivals.index') }}" class="nav-link {{ request()->routeIs('festivals.*') ? 'active' : '' }}">
                                <i class="fa fa-gift" aria-hidden="true"></i>
                                <p>Festivals</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('clients.index') }}" class="nav-link {{ request()->routeIs('clients.*') ? 'active' : '' }}">
                                <i class="fa fa-list-alt" aria-hidden="true"></i>
                                <p>Clients</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
