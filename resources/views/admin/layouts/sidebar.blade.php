<style>   
    .nav-treeview > .nav-item > .nav-link.active,
    .nav-treeview > .nav-item > .nav-link.active:hover {
        background-color: rgba(148, 163, 184, 0.9);
        color: #343a40;
        border-radius: 5px;
    }
</style>
<aside class="main-sidebar bg-slate-50 elevation-4">
    <div class="sidebar">
        <!-- User Panel -->
        <div class="user-panel mt-3 pb-1 mb-1 d-flex items-center">
            <div class="image">
                <i class="fas fa-user-circle fa-2x mt-2"></i> <!-- Adjust size as needed -->
            </div>
            
            <div class="info bg-gray-100 py-1 px-2 ml-2 mt-1 rounded-lg shadow-md text-center">
                <a href="{{ route('admin.dashboard') }}" class="block text-slate-500 hover:text-blue-800 font-semibold text-md">
                    {{ Auth::user()->name }}
                </a>
            </div>
        </div>
        

        <!-- Divider -->
        <hr class="bg-black">

        <!-- Navigation -->
        <nav class="mt-2">
            <ul class="nav nav-sidebar flex flex-col" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Users Link -->
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'bg-blue-400 text-white' : 'text-black hover:bg-blue-100' }} flex items-center p-2 rounded-md">
                        <i class="fa fa-user {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-black' }}" aria-hidden="true"></i>
                        <p class="ml-2">Users</p>
                    </a>
                </li>
                
                <!-- Festivals Link -->
                <li class="nav-item">
                    <a href="{{ route('admin.festivals.index') }}" class="nav-link {{ request()->routeIs('admin.festivals.*') ? 'bg-blue-400 text-white' : 'text-black hover:bg-blue-100' }} flex items-center p-2 rounded-md">
                        <i class="fa fa-gift {{ request()->routeIs('admin.festivals.*') ? 'text-white' : 'text-black' }}" aria-hidden="true"></i>
                        <p class="ml-2">Festivals</p>
                    </a>
                </li>
                
                <!-- Plans Link -->
                <li class="nav-item">
                    <a href="{{ route('admin.plans.index') }}" class="nav-link {{ request()->routeIs('admin.plans.*') ? 'bg-blue-400 text-white' : 'text-black hover:bg-blue-100' }} flex items-center p-2 rounded-md">
                        <i class="fa fa-calendar {{ request()->routeIs('admin.plans.*') ? 'text-white' : 'text-black' }}" aria-hidden="true"></i>
                        <p class="ml-2">Plans</p>
                    </a>
                </li>
            </ul>
        </nav>
        
        
    </div>
</aside>


