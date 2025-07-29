<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Boulanger Tracker')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
<div class="flex h-screen">
    <!-- Sidebar -->
    <div
        class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out"
        id="sidebar">
        <!-- App Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <a href="{{route('home.index')}}" class="flex items-center space-x-3">
                <div
                    class="w-8 h-8 bg-gradient-to-br from-orange-400 to-orange-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h1 class="text-xl font-bold text-gray-900">Boulanger Tracker</h1>
            </a>
            <!-- Mobile close button -->
            <button class="lg:hidden text-gray-500 hover:text-gray-700 cursor-pointer" onclick="toggleSidebar()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- User Section -->
        <div class="p-6 border-b border-gray-200">
            @auth
                <div class="relative" id="user-dropdown">
                    <button onclick="toggleUserDropdown()"
                            class="flex items-center space-x-3 w-full text-left hover:bg-gray-50 rounded-lg p-2 transition-colors duration-200">
                        @if(@auth()->user()->image)
                            <img
                                class="object-cover w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-semibold text-sm"
                                src="{{ asset('storage') . auth()->user()->image }}"
                                alt="Photo de profil de {{ auth()->user()->name }}">
                        @else
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                        </div>
                        <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" id="dropdown-arrow"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="dropdown-menu"
                         class="absolute left-0 right-0 mt-2 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50 hidden">

                        <!-- Profile (Coming Soon) -->
                        <div class="px-4 py-2">
                            <div class="flex items-center space-x-3 opacity-50 cursor-not-allowed">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span class="text-sm text-gray-400">Profil</span>
                                <span class="text-xs bg-gray-100 text-gray-500 px-2 py-1 rounded-full">Bientôt</span>
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="border-t border-gray-100 my-2"></div>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit"
                                    class="w-full px-4 py-2 text-left hover:bg-red-50 transition-colors duration-200 cursor-pointer">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    <span class="text-sm text-red-600 font-medium">Se déconnecter</span>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="text-center">
                    <div class="w-12 h-12 bg-gray-200 rounded-full mx-auto mb-3 flex items-center justify-center">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">Bienvenue sur Boulanger Tracker</p>
                    <div class="space-y-2">
                        <a href="{{ route('login.index') }}"
                           class="inline-flex items-center w-full px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            Se connecter
                        </a>
                        <a href="{{ route('register.index') }}"
                           class="inline-flex items-center w-full px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            Créer un compte
                        </a>
                    </div>
                </div>
            @endauth
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 p-4 space-y-2">
            @auth
                <a href="{{ route('trackers.index') }}"
                   class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition-colors duration-200 {{ request()->routeIs('trackers.index') ? 'bg-blue-50 text-blue-700' : '' }}">
                    <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184"/>
                    </svg>

                    Mes suivis
                </a>
            @endauth
        </nav>
    </div>

    <div class="fixed inset-0 z-40 bg-gray-600 bg-opacity-75 lg:hidden hidden" id="sidebar-overlay"
         onclick="toggleSidebar()"></div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col lg:ml-64">
        <!-- Mobile header -->
        <div class="lg:hidden bg-white shadow-sm border-b border-gray-200 px-4 py-3">
            <div class="flex items-center justify-between">
                <button class="text-gray-500 hover:text-gray-700 cursor-pointer" onclick="toggleSidebar()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h1 class="text-lg font-semibold text-gray-900">Boulanger Tracker</h1>
                <div class="w-6"></div>
            </div>
        </div>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto">
            @yield('content')
        </main>

        <!-- Flash Messages -->
        <div id="flash-messages" class="fixed top-4 right-4 z-50 space-y-3">
            @if(session()->has('success'))
                <x-flash-message type="success" :message="session('success')"/>
            @endif

            @if(session('error') || session('danger'))
                <x-flash-message type="error" :message="session('error') ?? session('danger')"/>
            @endif

            @if(session('warning'))
                <x-flash-message type="warning" :message="session('warning')"/>
            @endif

            @if(session('info'))
                <x-flash-message type="info" :message="session('info')"/>
            @endif
        </div>
    </div>
</div>

<script>
    toggleSidebar = function () {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        if (!sidebar || !overlay) {
            console.error('Sidebar or overlay elements not found');
            return;
        }

        if (sidebar.classList.contains('-translate-x-full')) {
            overlay.classList.remove('hidden');
            sidebar.classList.remove('-translate-x-full');
        } else {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }
    };

    toggleUserDropdown = function () {
        const dropdownMenu = document.getElementById('dropdown-menu');
        const dropdownArrow = document.getElementById('dropdown-arrow');

        if (!dropdownMenu || !dropdownArrow) {
            console.error('Dropdown elements not found');
            return;
        }

        const isOpen = !dropdownMenu.classList.contains('hidden');

        if (isOpen) {
            dropdownMenu.classList.add('hidden');
            dropdownArrow.classList.remove('rotate-180');
        } else {
            dropdownMenu.classList.remove('hidden');
            dropdownArrow.classList.add('rotate-180');
        }
    };

    document.addEventListener('click', function (event) {
        const userDropdown = document.getElementById('user-dropdown');
        const dropdownMenu = document.getElementById('dropdown-menu');
        const dropdownArrow = document.getElementById('dropdown-arrow');

        if (userDropdown && dropdownMenu && dropdownArrow && !userDropdown.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
            dropdownArrow.classList.remove('rotate-180');
        }
    });

    document.addEventListener('click', function (event) {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        // Ne pas fermer si on clique sur un bouton de toggle
        if (event.target.closest('button[onclick*="toggleSidebar"]')) {
            return;
        }

        if (window.innerWidth < 1024 && sidebar && overlay && !sidebar.contains(event.target) && !overlay.contains(event.target)) {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        const flashMessages = document.querySelectorAll('.flash-message');

        flashMessages.forEach((message, index) => {
            setTimeout(() => {
                message.classList.remove('translate-x-full');
                message.classList.add('translate-x-0');

                const progressBar = message.querySelector('[id^="progress-"]');
                if (progressBar) {
                    progressBar.style.width = '0%';
                    setTimeout(() => {
                        progressBar.style.width = '100%';
                    }, 100);
                }
            }, index * 100);

            setTimeout(() => {
                dismissFlash(message);
            }, 3000 + (index * 100));
        });
    });

    function dismissFlash(message) {
        message.classList.remove('translate-x-0');
        message.classList.add('translate-x-full');

        setTimeout(() => {
            if (message.parentElement) {
                message.remove();
            }
        }, 500);
    }

    // Helper function to find parent element with specific class
    function findParentElement(element, className) {
        while (element && element !== document) {
            if (element.classList && element.classList.contains(className)) {
                return element;
            }
            element = element.parentElement;
        }
        return null;
    }

    document.addEventListener('mouseenter', function (event) {
        const flashMessage = findParentElement(event.target, 'flash-message');
        if (flashMessage) {
            const progressBar = flashMessage.querySelector('[id^="progress-"]');
            if (progressBar) {
                progressBar.style.transition = 'none';
            }
        }
    });

    document.addEventListener('mouseleave', function (event) {
        const flashMessage = findParentElement(event.target, 'flash-message');
        if (flashMessage) {
            const progressBar = flashMessage.querySelector('[id^="progress-"]');
            if (progressBar) {
                progressBar.style.transition = 'width 3s linear';
            }
        }
    });

</script>
</body>
</html>
