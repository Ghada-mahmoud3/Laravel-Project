<nav x-data="{ open: false }" class="bg-white border-b shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo + Brand -->
            <div class="flex items-center space-x-3">
            @if (Auth::user()->role == 'candidate')
                <a href="{{ route('jobs.search') }}" class="flex items-center space-x-2">
                    <span class="text-xl font-bold text-indigo-700">Job Board</span>
                </a>

            @elseif (Auth::user()->role == 'employer')    

            @elseif (Auth::user()->role == 'admin')
                  <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
                    <span class="text-xl font-bold text-indigo-700">Job Board</span>
                    </a>
            @endif
                <!-- Primary Links -->
                <div class="hidden sm:flex space-x-6 ml-10">
                    <!-- <a href="{{ route('dashboard') }}"
                        class="text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-indigo-600' : 'text-gray-600 hover:text-indigo-600' }} transition">
                        Dashboard
                    </a> -->
                    <!-- @if (Auth::user()->role == 'candidate')
                    <a href="/applications"
                        class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition">Applications</a>
                    <a href="/profile"
                        class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition">Profile</a>
                    @endif -->

                    @if (Auth::user()->role == 'candidate')
                        <a href="/applications" class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition">Applications</a>
                         <a href="/profile" class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition">Profile</a>

                    @elseif (Auth::user()->role == 'employer')
                          <a href="/jobs" class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition">My Jobs</a>
                            <a href="/profile" class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition">Profile</a>

                    @elseif (Auth::user()->role == 'admin')
                       <a href="/admin/jobs" class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition">Jobs</a>
                        <a href="/admin/users" class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition">Users</a>
                    @endif

                   
                </div>
            </div>

            <!-- Right Side -->
            <div class="flex items-center space-x-4">
                <!-- User Dropdown -->
                <div class="hidden sm:flex items-center space-x-3">
                    <x-dropdown align="right" width="60">
                        <x-slot name="trigger">
                            <button class="flex items-center space-x-3 text-sm text-gray-700 hover:text-indigo-700 transition">
                                <img class="h-8 w-8 rounded-full border-2 border-indigo-600"
                                     src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4F46E5&color=fff"
                                     alt="Avatar">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.23 7.21a.75.75 0 011.06 0L10 10.94l3.71-3.73a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 010-1.06z"
                                          clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <div class="px-4 py-2 text-sm text-gray-600 border-b">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Mobile Hamburger -->
                <div class="sm:hidden">
                    <button @click="open = !open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                            <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden hidden border-t border-gray-200 bg-white">
        <div class="px-4 py-4 space-y-3">
            <a href="{{ route('dashboard') }}"
               class="block text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-indigo-600' : 'text-gray-700 hover:text-indigo-600' }} transition">
                Dashboard
            </a>
            <a href="#" class="block text-sm font-medium text-gray-700 hover:text-indigo-600 transition">Jobs</a>
            <a href="#" class="block text-sm font-medium text-gray-700 hover:text-indigo-600 transition">Candidates</a>
        </div>

        <!-- User Info -->
        <div class="border-t border-gray-100 px-4 py-4">
            <div class="flex items-center space-x-3">
                <img class="h-10 w-10 rounded-full border-2 border-indigo-600"
                     src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4F46E5&color=fff"
                     alt="Avatar">
                <div>
                    <div class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>
