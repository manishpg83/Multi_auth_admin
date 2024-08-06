<aside class="main-sidebar bg-slate-50 elevation-2">
    <div class="sidebar">
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
        <hr class="bg-black">
        <nav class="mt-2">
            <ul class="flex flex-col nav nav-sidebar">
                <!-- Dashboard Link -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link flex items-center p-2 rounded-md {{ request()->routeIs('dashboard') ? 'bg-green-700 text-yellow-400 font-bold' : 'text-black hover:bg-blue-100' }}">
                        <i class="fa fa-tachometer-alt {{ request()->routeIs('dashboard') ? 'text-yellow-400' : 'text-black' }} mr-2"></i>
                        <p class="{{ request()->routeIs('dashboard') ? 'text-yellow-400 font-bold' : 'text-black' }}">Dashboard</p>
                    </a>
                </li>

                <!-- Profile Link -->
                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}"
                        class="nav-link flex items-center p-2 rounded-md {{ request()->routeIs('profile.*') ? 'bg-green-700 text-yellow-400 font-bold' : 'text-black hover:bg-blue-100' }}">
                        <i class="fa fa-user {{ request()->routeIs('profile.*') ? 'text-yellow-400' : 'text-black' }} mr-2"></i>
                        <p class="{{ request()->routeIs('profile.*') ? 'text-yellow-400 font-bold' : 'text-black' }}">Profile</p>
                    </a>
                </li>

                <!-- SMTP Settings Link -->
                <li class="nav-item">
                    <a href="{{ route('smtp-settings') }}"
                        class="nav-link flex items-center p-2 rounded-md {{ request()->routeIs('smtp-settings') ? 'bg-green-700 text-yellow-400 font-bold' : 'text-black hover:bg-blue-100' }}">
                        <i class="fa fa-envelope {{ request()->routeIs('smtp-settings') ? 'text-yellow-400' : 'text-black' }} mr-2"></i>
                        <p class="{{ request()->routeIs('smtp-settings') ? 'text-yellow-400 font-bold' : 'text-black' }}">SMTP Settings</p>
                    </a>
                </li>

                <!-- Upload Client Link -->
                <li class="nav-item">
                    <a href="{{ route('upload-client') }}"
                        class="nav-link flex items-center p-2 rounded-md {{ request()->routeIs('upload-client') ? 'bg-green-700 text-yellow-400 font-bold' : 'text-black hover:bg-blue-100' }}">
                        <i class="fa fa-upload {{ request()->routeIs('upload-client') ? 'text-yellow-400' : 'text-black' }} mr-2"></i>
                        <p class="{{ request()->routeIs('upload-client') ? 'text-yellow-400 font-bold' : 'text-black' }}">Upload Client</p>
                    </a>
                </li>

                <!-- Festivals Link -->
                <li class="nav-item">
                    <a href="{{ route('festivals.index') }}"
                        class="nav-link flex items-center p-2 rounded-md {{ request()->routeIs('festivals.*') ? 'bg-green-700 text-yellow-400 font-bold' : 'text-black hover:bg-blue-100' }}">
                        <i class="fa fa-gift {{ request()->routeIs('festivals.*') ? 'text-yellow-400' : 'text-black' }} mr-2"></i>
                        <p class="{{ request()->routeIs('festivals.*') ? 'text-yellow-400 font-bold' : 'text-black' }}">Festivals</p>
                    </a>
                </li>
                
                <!-- Clients Link -->
                <li class="nav-item">
                    <a href="{{ route('clients.index') }}"
                        class="nav-link flex items-center p-2 rounded-md {{ request()->routeIs('clients.*') ? 'bg-green-700 text-yellow-400 font-bold' : 'text-black hover:bg-blue-100' }}">
                        <i class="fa fa-list-alt {{ request()->routeIs('clients.*') ? 'text-yellow-400' : 'text-black' }} mr-2"></i>
                        <p class="{{ request()->routeIs('clients.*') ? 'text-yellow-400 font-bold' : 'text-black' }}">Clients</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
