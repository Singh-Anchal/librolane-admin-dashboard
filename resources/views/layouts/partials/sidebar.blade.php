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
            <div class="size-8 rounded bg-gray-600 flex items-center justify-center text-white font-bold text-xs">PS
            </div>
            <div class="min-w-0 flex-1">
                <p class="truncate text-xs font-bold text-white">Principal Smith</p>
                <p class="truncate text-[10px] text-gray-400">Administrator</p>
            </div>
        </div>
    </div>
</aside>
