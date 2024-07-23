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
                <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item {{ request()->routeIs('admin.users.*') || request()->routeIs('admin.festivals.*') || request()->routeIs('admin.plans.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link parent-menu {{ request()->routeIs('admin.users.*') || request()->routeIs('admin.festivals.*') || request()->routeIs('admin.plans.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Manage
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.festivals.index') }}" class="nav-link {{ request()->routeIs('admin.festivals.*') ? 'active' : '' }}">
                                <i class="fa fa-gift" aria-hidden="true"></i>
                                <p>Festivals</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.plans.index') }}" class="nav-link {{ request()->routeIs('admin.plans.*') ? 'active' : '' }}">
                                <i class="fa fa-gift" aria-hidden="true"></i>
                                <p>Plans</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
