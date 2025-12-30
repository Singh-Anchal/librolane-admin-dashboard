<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>@yield('title', 'SchoolAdmin') | Velzon Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    {{-- Assuming you have your Vite setup, uncomment above. For now using Tailwind CDN for testing if needed --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'v-bg': '#f3f3f9',
                        'v-primary': '#405189',
                        'v-secondary': '#3577f1',
                        'v-dark': '#212529',
                    },
                    fontFamily: {
                        'display': ['Lexend', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        /* --- PRELOADER & TOAST CSS (Kept from your original code) --- */
        #preloader { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: #f3f3f9; z-index: 9999; display: flex; justify-content: center; align-items: center; transition: opacity 0.5s ease, visibility 0.5s ease; }
        #preloader.hidden-loader { opacity: 0; visibility: hidden; }
        .spinner { width: 50px; height: 50px; border: 3px solid #e2e2e2; border-top: 4px solid #405189; border-radius: 50%; animation: spin 1s linear infinite; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        .toast-enter { transform: translateX(100%); opacity: 0; }
        .toast-enter-active { transform: translateX(0); opacity: 1; transition: all 0.3s ease-out; }
        .toast-exit { transform: translateX(0); opacity: 1; }
        .toast-exit-active { transform: translateX(100%); opacity: 0; transition: all 0.3s ease-in; }
    </style>
</head>

<body class="font-display bg-v-bg text-[#495057] antialiased">

    <div id="preloader">
        <div class="flex flex-col items-center gap-2">
            <div class="spinner"></div>
            <p class="text-xs font-bold text-v-primary tracking-widest mt-2">LOADING...</p>
        </div>
    </div>

    <div id="toast-container" class="fixed top-5 right-5 z-[100] space-y-3 pointer-events-none"></div>

    <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 z-40 bg-black/50 hidden lg:hidden"></div>

    <div class="flex min-h-screen">

        @include('layouts.partials.sidebar')

        <main id="main-content" class="flex flex-1 flex-col min-w-0 ml-0 lg:ml-[250px] transition-all duration-300">

            @include('layouts.partials.topbar')

            <div class="p-4 lg:p-6 space-y-6">
                @yield('content')
            </div>

            @include('layouts.partials.footer')

        </main>
    </div>

    <script>
        // 1. SIDEBAR LOGIC
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const overlay = document.getElementById('sidebar-overlay');

            if (window.innerWidth >= 1024) {
                sidebar.classList.toggle('lg:translate-x-0');
                mainContent.classList.toggle('lg:ml-[250px]');
            } else {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            }
        }

        // 2. PRELOADER
        const preloader = document.getElementById('preloader');
        window.addEventListener('load', function() { hideLoader(); });
        function showLoader(autoHideDuration = null) {
            preloader.classList.remove('hidden-loader');
            if(autoHideDuration) setTimeout(hideLoader, autoHideDuration);
        }
        function hideLoader() { preloader.classList.add('hidden-loader'); }

        // 3. TOAST SYSTEM
        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const configs = {
                success: { bg: 'bg-white', border: 'border-l-4 border-emerald-500', text: 'text-emerald-600', icon: 'check_circle' },
                error:   { bg: 'bg-white', border: 'border-l-4 border-red-500', text: 'text-red-500', icon: 'error' },
                warning: { bg: 'bg-white', border: 'border-l-4 border-amber-500', text: 'text-amber-500', icon: 'warning' },
                info:    { bg: 'bg-white', border: 'border-l-4 border-blue-500', text: 'text-blue-500', icon: 'info' }
            };
            const config = configs[type] || configs.success;
            const toast = document.createElement('div');
            toast.className = `pointer-events-auto flex w-full max-w-xs items-center gap-3 rounded-md ${config.bg} p-4 shadow-lg ${config.border} toast-enter`;
            toast.innerHTML = `<span class="material-symbols-outlined ${config.text}">${config.icon}</span><div class="flex-1"><p class="text-sm font-medium text-gray-700">${message}</p></div><button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600"><span class="material-symbols-outlined text-[18px]">close</span></button>`;
            container.appendChild(toast);
            requestAnimationFrame(() => { toast.classList.remove('toast-enter'); toast.classList.add('toast-enter-active'); });
            setTimeout(() => { toast.classList.remove('toast-enter-active'); toast.classList.add('toast-exit-active'); toast.addEventListener('transitionend', () => { toast.remove(); }); }, 4000);
        }
    </script>

    {{-- Session Flashing --}}
    @if (session('success')) <script> document.addEventListener('DOMContentLoaded', () => showToast("{{ session('success') }}", 'success')); </script> @endif
    @if (session('error')) <script> document.addEventListener('DOMContentLoaded', () => showToast("{{ session('error') }}", 'error')); </script> @endif
    @if (session('warning')) <script> document.addEventListener('DOMContentLoaded', () => showToast("{{ session('warning') }}", 'warning')); </script> @endif
    @if (session('info')) <script> document.addEventListener('DOMContentLoaded', () => showToast("{{ session('info') }}", 'info')); </script> @endif

</body>
</html>