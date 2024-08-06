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
        <div class="pb-1 mt-3 mb-1 user-panel d-flex">
            <div class="image">
                <img src="{{ asset('images/logo1.jpeg') }}" alt="User Image" class="object-cover w-18 h-18">
            </div>            
            <div class="info bg-yellow-400 py-0.5 px-2 ml-2 rounded-lg shadow-md">
                <a href="{{ route('welcome') }}" class="block text-green-700 hover:text-green-800 font-semibold text-md mt-0.5">
                    Lttrsnd
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
                    <a href="{{ route('admin.users.index') }}"
                        class="nav-link flex items-center p-2 rounded-md {{ request()->routeIs('admin.users.*') ? 'bg-green-700 text-yellow-400 font-bold' : 'text-black hover:bg-blue-100' }}">
                        <i class="fa fa-user {{ request()->routeIs('admin.users.*') ? 'text-yellow-400' : 'text-black' }}" aria-hidden="true"></i>
                        <p class="{{ request()->routeIs('admin.users.*') ? 'text-yellow-400 font-bold' : 'text-black' }} ml-2">Users</p>
                    </a>
                </li>
                
                <!-- Festivals Link -->
                <li class="nav-item">
                    <a href="{{ route('admin.festivals.index') }}"
                        class="nav-link flex items-center p-2 rounded-md {{ request()->routeIs('admin.festivals.*') ? 'bg-green-700 text-yellow-400 font-bold' : 'text-black hover:bg-blue-100' }}">
                        <i class="fa fa-gift {{ request()->routeIs('admin.festivals.*') ? 'text-yellow-400' : 'text-black' }}" aria-hidden="true"></i>
                        <p class="{{ request()->routeIs('admin.festivals.*') ? 'text-yellow-400 font-bold' : 'text-black' }} ml-2">Festivals</p>
                    </a>
                </li>
                
                <!-- Plans Link -->
                <li class="nav-item">
                    <a href="{{ route('admin.plans.index') }}"
                        class="nav-link flex items-center p-2 rounded-md {{ request()->routeIs('admin.plans.*') ? 'bg-green-700 text-yellow-400 font-bold' : 'text-black hover:bg-blue-100' }}">
                        <i class="fa fa-calendar {{ request()->routeIs('admin.plans.*') ? 'text-yellow-400' : 'text-black' }}" aria-hidden="true"></i>
                        <p class="{{ request()->routeIs('admin.plans.*') ? 'text-yellow-400 font-bold' : 'text-black' }} ml-2">Plans</p>
                    </a>
                </li>
            </ul>
        </nav>
        
        
        
    </div>
</aside>


