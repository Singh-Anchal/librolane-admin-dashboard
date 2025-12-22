<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>SchoolAdmin | Velzon Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* --- 2. PRELOADER CSS --- */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #f3f3f9;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        #preloader.hidden-loader {
            opacity: 0;
            visibility: hidden;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 3px solid #e2e2e2;
            border-top: 4px solid #405189;
            /* v-primary */
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* --- 3. TOAST ANIMATION CSS --- */
        .toast-enter {
            transform: translateX(100%);
            opacity: 0;
        }

        .toast-enter-active {
            transform: translateX(0);
            opacity: 1;
            transition: all 0.3s ease-out;
        }

        .toast-exit {
            transform: translateX(0);
            opacity: 1;
        }

        .toast-exit-active {
            transform: translateX(100%);
            opacity: 0;
            transition: all 0.3s ease-in;
        }
    </style>
</head>

<body class="font-display bg-v-bg text-[#495057] antialiased">

    <div id="preloader">
        <div class="flex flex-col items-center gap-2">
            <div class="spinner"></div>
            <p class="text-xs font-bold text-v-primary tracking-widest mt-2">LOADING...</p>
        </div>
    </div>

    <div id="toast-container" class="fixed top-5 right-5 z-[100] space-y-3 pointer-events-none">
    </div>

    <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 z-40 bg-black/50 hidden lg:hidden"></div>

    <div class="flex min-h-screen">

        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-50 flex w-[250px] flex-col bg-v-dark text-[#abb9e8] shadow-xl lg:translate-x-0 -translate-x-full transition-transform duration-300">

            <div class="flex h-16 items-center justify-between px-6">
                <div class="flex items-center gap-3">
                    <div class="flex size-8 items-center justify-center rounded bg-v-primary/20">
                        <span class="material-symbols-outlined text-v-secondary">school</span>
                    </div>
                    <h2 class="brand-text text-lg font-bold text-white tracking-wide">SchoolAdmin</h2>
                </div>
                <button onclick="toggleSidebar()" class="lg:hidden text-gray-400 hover:text-white transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto px-3 py-4">
                <p class="menu-label mb-2 px-3 text-[10px] font-bold uppercase tracking-widest text-[#838fb9]">Menu</p>
                <nav class="space-y-1">
                    <a href="#"
                        class="flex items-center gap-3 rounded-md bg-white/10 px-3 py-2.5 text-white transition-all">
                        <span class="material-symbols-outlined">dashboard</span>
                        <span class="nav-text text-[13.5px] font-medium">Dashboard</span>
                    </a>

                    <a href="javascript:void(0)"
                        onclick="showLoader(1000); setTimeout(() => showToast('Student list refreshed', 'success'), 1000);"
                        class="flex items-center gap-3 rounded-md px-3 py-2.5 hover:text-white transition-all">
                        <span class="material-symbols-outlined">groups</span>
                        <span class="nav-text text-[13.5px] font-medium">Students (Test Load)</span>
                    </a>

                    <a href="javascript:void(0)" onclick="showToast('Access Denied!', 'error')"
                        class="flex items-center gap-3 rounded-md px-3 py-2.5 hover:text-white transition-all">
                        <span class="material-symbols-outlined">badge</span>
                        <span class="nav-text text-[13.5px] font-medium">Staff (Test Error)</span>
                    </a>

                    <a href="#"
                        class="flex items-center gap-3 rounded-md px-3 py-2.5 hover:text-white transition-all">
                        <span class="material-symbols-outlined text-[20px]">school</span>
                        <span class="nav-text text-[13.5px] font-medium">Academics</span>
                    </a>
                    <a href="#"
                        class="flex items-center gap-3 rounded-md px-3 py-2.5 hover:text-white transition-all">
                        <span class="material-symbols-outlined text-[20px]">payments</span>
                        <span class="nav-text text-[13.5px] font-medium">Finance</span>
                    </a>
                    <a href="#"
                        class="flex items-center gap-3 rounded-md px-3 py-2.5 hover:text-white transition-all">
                        <span class="material-symbols-outlined text-[20px]">campaign</span>
                        <span class="nav-text text-[13.5px] font-medium">Communications</span>
                    </a>
                    <a href="#"
                        class="flex items-center gap-3 rounded-md px-3 py-2.5 hover:text-white transition-all">
                        <span class="material-symbols-outlined text-[20px]">bar_chart</span>
                        <span class="nav-text text-[13.5px] font-medium">Reports</span>
                    </a>
                </nav>
            </div>

            <div class="sidebar-footer border-t border-white/10 p-4">
                <div class="flex items-center gap-3 rounded-lg bg-white/5 p-2">
                    <div
                        class="size-8 rounded bg-gray-600 flex items-center justify-center text-white font-bold text-xs">
                        PS</div>
                    <div class="min-w-0 flex-1">
                        <p class="truncate text-xs font-bold text-white">Principal Smith</p>
                        <p class="truncate text-[10px] text-gray-400">Administrator</p>
                    </div>
                </div>
            </div>
        </aside>

        <main id="main-content" class="flex flex-1 flex-col min-w-0 ml-0 lg:ml-[250px] transition-all duration-300">

            <header class="sticky top-0 z-30 flex h-16 items-center justify-between bg-white px-4 shadow-sm lg:px-6">
                <div class="flex items-center gap-4">
                    <button onclick="toggleSidebar()"
                        class="flex h-10 w-10 items-center justify-center rounded text-[#495057] hover:bg-gray-100 transition-colors">
                        <span class="material-symbols-outlined">menu_open</span>
                    </button>

                    <div class="hidden sm:block">
                        <h1 class="text-sm font-bold text-[#495057]">Welcome back, Principal Smith!</h1>
                        <p class="text-[11px] text-[#878a99]">Overview for December 2025</p>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <div class="hidden md:flex relative mr-2">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">search</span>
                        <input type="text" placeholder="Search..."
                            class="h-9 w-48 rounded border-none bg-v-bg pl-9 text-xs focus:ring-1 focus:ring-v-primary">
                    </div>

                    <button onclick="showToast('Searching database...', 'info')"
                        class="relative flex h-9 w-9 items-center justify-center rounded hover:bg-gray-100 text-[#495057]">
                        <span class="material-symbols-outlined">search</span>
                    </button>

                    <button onclick="showToast('You have 3 unread notifications', 'warning')"
                        class="relative flex h-9 w-9 items-center justify-center rounded hover:bg-gray-100 text-[#495057]">
                        <span class="material-symbols-outlined">notifications</span>
                        <span
                            class="absolute top-2 right-2 h-2 w-2 rounded-full bg-rose-500 border-2 border-white"></span>
                    </button>
                </div>
            </header>

            <div class="p-4 lg:p-6 space-y-6">
                <div class="rounded-md bg-white p-6 shadow-sm border border-v-primary/20">
                    <h5 class="font-bold text-[#495057] mb-2">Developer Tools (Test Functions)</h5>
                    <p class="text-xs text-gray-500 mb-4">Use these buttons to test the new Preloader and Toast
                        notification system.</p>
                    <div class="flex flex-wrap gap-2">
                        <button onclick="showToast('Saved Successfully!', 'success')"
                            class="px-3 py-1.5 bg-green-50 text-green-600 border border-green-200 text-xs font-bold rounded hover:bg-green-100">Test
                            Success</button>
                        <button onclick="showToast('Something went wrong.', 'error')"
                            class="px-3 py-1.5 bg-red-50 text-red-600 border border-red-200 text-xs font-bold rounded hover:bg-red-100">Test
                            Error</button>
                        <button onclick="showToast('Please check input.', 'warning')"
                            class="px-3 py-1.5 bg-amber-50 text-amber-600 border border-amber-200 text-xs font-bold rounded hover:bg-amber-100">Test
                            Warning</button>
                        <button onclick="showLoader(2000)"
                            class="px-3 py-1.5 bg-v-primary text-white border border-v-primary text-xs font-bold rounded hover:bg-v-primary/90">Test
                            Loader (2s)</button>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <div
                        class="flex items-center justify-between rounded-md bg-white p-5 shadow-sm border-b-2 border-v-secondary/10">
                        <div>
                            <p class="text-[11px] font-bold text-[#878a99] uppercase tracking-wide">Total Students</p>
                            <h4 class="mt-2 text-xl font-bold text-[#495057]">1,250</h4>
                        </div>
                        <div
                            class="flex size-12 items-center justify-center rounded bg-v-secondary/10 text-v-secondary">
                            <span class="material-symbols-outlined">groups</span>
                        </div>
                    </div>
                    <div
                        class="flex items-center justify-between rounded-md bg-white p-5 shadow-sm border-b-2 border-emerald-500/10">
                        <div>
                            <p class="text-[11px] font-bold text-[#878a99] uppercase tracking-wide">Total Staff</p>
                            <h4 class="mt-2 text-xl font-bold text-[#495057]">85</h4>
                        </div>
                        <div
                            class="flex size-12 items-center justify-center rounded bg-emerald-500/10 text-emerald-500">
                            <span class="material-symbols-outlined">badge</span>
                        </div>
                    </div>
                    <div
                        class="flex items-center justify-between rounded-md bg-white p-5 shadow-sm border-b-2 border-amber-500/10">
                        <div>
                            <p class="text-[11px] font-bold text-[#878a99] uppercase tracking-wide">Attendance</p>
                            <h4 class="mt-2 text-xl font-bold text-[#495057]">95%</h4>
                        </div>
                        <div class="flex size-12 items-center justify-center rounded bg-amber-500/10 text-amber-500">
                            <span class="material-symbols-outlined">checklist</span>
                        </div>
                    </div>
                    <div
                        class="flex items-center justify-between rounded-md bg-white p-5 shadow-sm border-b-2 border-rose-500/10">
                        <div>
                            <p class="text-[11px] font-bold text-[#878a99] uppercase tracking-wide">On Leave</p>
                            <h4 class="mt-2 text-xl font-bold text-[#495057]">4</h4>
                        </div>
                        <div class="flex size-12 items-center justify-center rounded bg-rose-500/10 text-rose-600">
                            <span class="material-symbols-outlined">event_busy</span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                    <div class="lg:col-span-2 rounded-md bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h5 class="font-bold text-[#495057]">Fee Collection Overview</h5>
                                <p class="text-xl font-bold text-v-primary mt-1">$150,000 <span
                                        class="text-[10px] text-[#878a99] font-normal">This Month</span></p>
                            </div>
                            <button class="text-xs font-bold text-v-primary hover:underline">View Report</button>
                        </div>
                        <div class="flex items-end justify-around gap-4 h-64 border-b border-gray-100 px-2">
                            <div class="w-full bg-v-primary/10 rounded-t h-[75%]"></div>
                            <div class="w-full bg-v-primary/20 rounded-t h-[60%]"></div>
                            <div class="w-full bg-v-primary/30 rounded-t h-[50%]"></div>
                            <div class="w-full bg-v-primary rounded-t h-[90%]"></div>
                        </div>
                        <div class="flex justify-around mt-3 text-[11px] font-bold text-[#878a99]">
                            <span>Week 1</span><span>Week 2</span><span>Week 3</span><span>Week 4</span>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="rounded-md bg-white p-6 shadow-sm">
                            <h5 class="font-bold text-[#495057] mb-6">Recent Announcements</h5>
                            <div class="space-y-4">
                                <div class="pb-3 border-b border-gray-50">
                                    <p
                                        class="text-[13px] font-semibold text-[#495057] hover:text-v-primary cursor-pointer transition-colors">
                                        Annual Sports Day Schedule</p>
                                    <p class="text-[11px] text-[#878a99]">Posted on: 12th July 2024</p>
                                </div>
                                <div class="pb-3 border-b border-gray-50">
                                    <p
                                        class="text-[13px] font-semibold text-[#495057] hover:text-v-primary cursor-pointer transition-colors">
                                        Parent-Teacher Meeting Notice</p>
                                    <p class="text-[11px] text-[#878a99]">Posted on: 10th July 2024</p>
                                </div>
                                <div class="pb-1">
                                    <p
                                        class="text-[13px] font-semibold text-[#495057] hover:text-v-primary cursor-pointer transition-colors">
                                        Science Fair Submissions Open</p>
                                    <p class="text-[11px] text-[#878a99]">Posted on: 8th July 2024</p>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-md bg-white p-6 shadow-sm">
                            <h5 class="font-bold text-[#495057] mb-6">Upcoming Events</h5>
                            <div class="space-y-4">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="flex flex-col items-center justify-center rounded-md bg-v-primary/10 px-3 py-1.5 text-v-primary min-w-[50px]">
                                        <span class="text-[10px] font-bold uppercase">Jul</span>
                                        <span class="text-base font-black">25</span>
                                    </div>
                                    <div>
                                        <p class="text-[13px] font-bold text-[#495057]">Mid-Term Examinations</p>
                                        <p class="text-[11px] text-[#878a99]">All Grades</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div
                                        class="flex flex-col items-center justify-center rounded-md bg-v-primary/10 px-3 py-1.5 text-v-primary min-w-[50px]">
                                        <span class="text-[10px] font-bold uppercase">Aug</span>
                                        <span class="text-base font-black">15</span>
                                    </div>
                                    <div>
                                        <p class="text-[13px] font-bold text-[#495057]">School Foundation Day</p>
                                        <p class="text-[11px] text-[#878a99]">Special Assembly</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-md bg-white p-6 shadow-sm">
                    <h5 class="font-bold text-[#495057] mb-5">Quick Actions</h5>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <button onclick="showToast('Opening Student Form...', 'info'); showLoader(500);"
                            class="flex items-center gap-3 rounded border border-gray-100 bg-v-bg/50 p-3 hover:bg-white hover:shadow-md transition-all">
                            <span
                                class="material-symbols-outlined text-v-primary bg-white p-2 rounded shadow-sm">person_add</span>
                            <span class="text-xs font-bold text-[#495057]">Add New Student</span>
                        </button>
                        <button
                            class="flex items-center gap-3 rounded border border-gray-100 bg-v-bg/50 p-3 hover:bg-white hover:shadow-md transition-all">
                            <span
                                class="material-symbols-outlined text-v-primary bg-white p-2 rounded shadow-sm">groups</span>
                            <span class="text-xs font-bold text-[#495057]">Manage Staff</span>
                        </button>
                        <button
                            class="flex items-center gap-3 rounded border border-gray-100 bg-v-bg/50 p-3 hover:bg-white hover:shadow-md transition-all">
                            <span
                                class="material-symbols-outlined text-v-primary bg-white p-2 rounded shadow-sm">receipt_long</span>
                            <span class="text-xs font-bold text-[#495057]">Fee Reports</span>
                        </button>
                        <button
                            class="flex items-center gap-3 rounded border border-gray-100 bg-v-bg/50 p-3 hover:bg-white hover:shadow-md transition-all">
                            <span
                                class="material-symbols-outlined text-v-primary bg-white p-2 rounded shadow-sm">calendar_month</span>
                            <span class="text-xs font-bold text-[#495057]">Academic Calendar</span>
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>
<script>
        // 1. SIDEBAR LOGIC (Fixed for Desktop)
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const overlay = document.getElementById('sidebar-overlay');

            if (window.innerWidth >= 1024) {
                // Desktop Toggle:
                // We toggle the specific Tailwind classes that keep the sidebar visible ('lg:translate-x-0')
                // and the main content indented ('lg:ml-[250px]').
                sidebar.classList.toggle('lg:translate-x-0');
                mainContent.classList.toggle('lg:ml-[250px]');
            } else {
                // Mobile Toggle:
                // We toggle the negative translation to slide it in/out
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            }
        }

        // 2. PRELOADER FUNCTIONALITY
        const preloader = document.getElementById('preloader');

        window.addEventListener('load', function() {
            hideLoader();
        });

        function showLoader(autoHideDuration = null) {
            preloader.classList.remove('hidden-loader');
            if(autoHideDuration) {
                setTimeout(hideLoader, autoHideDuration);
            }
        }

        function hideLoader() {
            preloader.classList.add('hidden-loader');
        }

        // 3. TOAST / NOTIFICATION SYSTEM
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
            
            toast.innerHTML = `
                <span class="material-symbols-outlined ${config.text}">${config.icon}</span>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-700">${message}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                </button>
            `;

            container.appendChild(toast);

            requestAnimationFrame(() => {
                toast.classList.remove('toast-enter');
                toast.classList.add('toast-enter-active');
            });

            setTimeout(() => {
                toast.classList.remove('toast-enter-active');
                toast.classList.add('toast-exit-active');
                toast.addEventListener('transitionend', () => {
                    toast.remove();
                });
            }, 4000);
        }
    </script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast("{{ session('success') }}", 'success');
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast("{{ session('error') }}", 'error');
            });
        </script>
    @endif

    @if (session('warning'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast("{{ session('warning') }}", 'warning');
            });
        </script>
    @endif

    @if (session('info'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast("{{ session('info') }}", 'info');
            });
        </script>
    @endif

</body>

</html>
