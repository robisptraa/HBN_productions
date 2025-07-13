<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/">
                        <x-application-logo
                            class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200 rounded-full overflow-hidden" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @guest
                        <x-nav-link href="#portfolio">
                            {{ __('Portofolio') }}
                        </x-nav-link>
                        <x-nav-link href="#about">
                            {{ __('Tentang Kami') }}
                        </x-nav-link>
                        <x-nav-link href="#contact">
                            {{ __('Kontak') }}
                        </x-nav-link>
                    @endguest

                    @auth
                        @if (auth()->user()->role->name === 'user')
                            <x-nav-link href="#portfolio">
                                {{ __('Portofolio') }}
                            </x-nav-link>
                            <x-nav-link href="#about">
                                {{ __('Tentang Kami') }}
                            </x-nav-link>
                            <x-nav-link href="#contact">
                                {{ __('Kontak') }}
                            </x-nav-link>
                        @endif

                        @if (auth()->user()->role->name === 'admin')
                            <x-nav-link :href="route('packages.index')" :active="request()->routeIs('packages.index')">
                                {{ __('Packages') }}
                            </x-nav-link>
                            <x-nav-link :href="route('complaints.index')" :active="request()->routeIs('complaints.index')">
                                {{ __('Complaints') }}
                            </x-nav-link>
                            <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                                {{ __('Products') }}
                            </x-nav-link>
                            <x-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.index')">
                                {{ __('Orders') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown or Login Button -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">
                @auth
                    {{-- Tampilkan status langganan kalau ada --}}
                    @if (auth()->user()->userPackages()->where('end_date', '>', now())->exists())
                        <span class="text-green-500 font-medium text-sm">Langganan Aktif</span>
                    @endif

                    {{-- Dropdown Notifikasi --}}
                    @if (auth()->user()->role->name === 'user')
                        <div x-data="{ openNotif: false }" class="relative">
                            <button @click="openNotif = !openNotif"
                                class="relative text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                                🔔
                                @if (auth()->user()->notifications()->count())
                                    <span class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full text-xs px-1">
                                        {{ auth()->user()->notifications()->count() }}
                                    </span>
                                @endif
                            </button>

                            <div x-show="openNotif" @click.away="openNotif = false"
                                class="absolute right-0 mt-2 w-64 bg-white dark:bg-gray-800 shadow rounded p-2 z-50">
                                <h4
                                    class="font-bold mb-2 text-sm text-gray-700 dark:text-gray-200 border-b border-gray-200 dark:border-gray-700">
                                    Notifikasi</h4>
                                @forelse(auth()->user()->notifications()->latest()->take(5)->get() as $notification)
                                    <div
                                        class="text-sm text-gray-600 dark:text-gray-300 border-b border-gray-200 dark:border-gray-700 px-2 py-4">
                                        {{ $notification->message }}
                                    </div>
                                @empty
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Tidak ada notifikasi.</div>
                                @endforelse
                            </div>
                        </div>
                    @endif


                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}"
                        class="inline-block px-5 py-1.5 text-white bg-cyan-600 hover:scale-105 transition-all rounded-sm text-sm leading-normal">
                        Log in
                    </a>
                    <a href="{{ route('register') }}"
                        class="inline-block px-5 py-1.5 text-white bg-cyan-600 hover:scale-105 transition-all rounded-sm text-sm leading-normal">
                        Register
                    </a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @guest
                <x-responsive-nav-link href="#portfolio">
                    {{ __('Portofolio') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="#about">
                    {{ __('Tentang Kami') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="#contact">
                    {{ __('Kontak') }}
                </x-responsive-nav-link>
            @endguest

            @auth
                @if (auth()->user()->role->name === 'user')
                    <x-responsive-nav-link href="#portfolio">
                        {{ __('Portofolio') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="#about">
                        {{ __('Tentang Kami') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="#contact">
                        {{ __('Kontak') }}
                    </x-responsive-nav-link>
                @endif

                @if (auth()->user()->role->name === 'admin')
                    <x-responsive-nav-link :href="route('packages.index')" :active="request()->routeIs('packages.index')">
                        {{ __('Packages') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('complaints.index')" :active="request()->routeIs('complaints.index')">
                        {{ __('Complaints') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                        {{ __('Products') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.index')">
                        {{ __('Orders') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="px-4 py-3">
                    <a href="{{ route('login') }}" class="text-gray-800 dark:text-gray-100 font-medium hover:underline">
                        {{ __('Login') }}
                    </a>
                </div>
            @endauth
        </div>

    </div>
</nav>
