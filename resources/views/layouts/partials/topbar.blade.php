<header class="sticky top-0 z-30 flex h-16 items-center justify-between bg-white px-4 shadow-sm lg:px-6">
    <div class="flex items-center gap-4">
        <button onclick="toggleSidebar()"
            class="flex h-10 w-10 items-center justify-center rounded text-[#495057] hover:bg-gray-100 transition-colors">
            <span class="material-symbols-outlined">menu_open</span>
        </button>

        <div class="hidden sm:block">
            <h1 class="text-sm font-bold text-[#495057]">Welcome back, Principal Smith!</h1>
            <p class="text-[11px] text-[#878a99]">Overview for {{ date('F Y') }}</p>
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
            <span class="absolute top-2 right-2 h-2 w-2 rounded-full bg-rose-500 border-2 border-white"></span>
        </button>
    </div>
</header>
