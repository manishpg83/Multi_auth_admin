<aside class="main-sidebar bg-slate-50 elevation-2">
    <div class="sidebar">
        <div class="user-panel mt-3 pb-1 mb-1 d-flex">
            <div class="image">
                <img src="{{ asset('images/logo1.jpeg') }}" alt="User Image" class="w-18 h-18 object-cover">
            </div>            
            <div class="info bg-yellow-400 py-0.5 px-2 ml-2 rounded-lg shadow-md">
                <a href="{{ route('welcome') }}" class="block text-green-700 hover:text-green-800 font-semibold text-md mt-0.5">
                    Lttrsnd
                </a>
            </div>
        </div>        
        <hr class="bg-black">
        <nav class="mt-2">
            <ul class="nav nav-sidebar flex flex-col">
                <!-- Dashboard Link -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link flex items-center p-2 rounded-md {{ request()->routeIs('dashboard') ? 'bg-blue-400 text-white' : 'text-black hover:bg-blue-100' }}">
                        <i class="fa fa-tachometer-alt {{ request()->routeIs('dashboard') ? 'text-white' : 'text-black' }} mr-2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Profile Link -->
                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}"
                        class="nav-link flex items-center p-2 rounded-md {{ request()->routeIs('profile.*') ? 'bg-blue-400 text-white' : 'text-black hover:bg-blue-100' }}">
                        <i class="fa fa-user {{ request()->routeIs('profile.*') ? 'text-white' : 'text-black' }} mr-2"></i>
                        <p>Profile</p>
                    </a>
                </li>

                <!-- SMTP Settings Link -->
                <li class="nav-item">
                    <a href="{{ route('smtp-settings') }}"
                        class="nav-link flex items-center p-2 rounded-md {{ request()->routeIs('smtp-settings') ? 'bg-blue-400 text-white' : 'text-black hover:bg-blue-100' }}">
                        <i class="fa fa-envelope {{ request()->routeIs('smtp-settings') ? 'text-white' : 'text-black' }} mr-2"></i>
                        <p>SMTP Settings</p>
                    </a>
                </li>


                <!-- Upload Client Link -->
                <li class="nav-item">
                    <a href="{{ route('upload-client') }}"
                        class="nav-link flex items-center p-2 rounded-md {{ request()->routeIs('upload-client') ? 'bg-blue-400 text-white' : 'text-black hover:bg-blue-100' }}">
                        <i class="fa fa-upload {{ request()->routeIs('upload-client') ? 'text-white' : 'text-black' }} mr-2"></i>
                        <p>Upload Client</p>
                    </a>
                </li>

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