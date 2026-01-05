<aside id="sidebar"
    class="fixed inset-y-0 left-0 z-50 flex w-[250px] flex-col bg-v-dark text-[#abb9e8] shadow-xl
           lg:translate-x-0 -translate-x-full transition-transform duration-300"
    {{-- 
       ALPINE DATA:
       1. Check LocalStorage first ('settings_menu_state').
       2. Fallback: If URL contains 'settings', force it open.
       3. Watch changes and save to LocalStorage.
    --}} x-data="{
        settingsOpen: localStorage.getItem('settings_menu_state') === 'true' ||
            {{ request()->is('settings*') ? 'true' : 'false' }}
    }" x-init="$watch('settingsOpen', val => localStorage.setItem('settings_menu_state', val))">

    <div class="flex h-16 items-center justify-between px-6 border-b border-white/10">
        <div class="flex items-center gap-3">
            <div class="flex size-8 items-center justify-center rounded bg-v-primary/20">
                <span class="material-symbols-outlined text-v-secondary">school</span>
            </div>
            <h2 class="brand-text text-lg font-bold text-white tracking-wide">
                SchoolAdmin
            </h2>
        </div>
        <button onclick="toggleSidebar()" class="lg:hidden text-gray-400 hover:text-white transition-colors">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>

    <div id="sidebar-scroll-container"
        class="flex-1 overflow-y-auto px-3 py-4 overscroll-contain
               [&::-webkit-scrollbar]:w-1.5
               [&::-webkit-scrollbar-track]:bg-transparent
               [&::-webkit-scrollbar-thumb]:bg-white/10
               [&::-webkit-scrollbar-thumb]:rounded-full
               hover:[&::-webkit-scrollbar-thumb]:bg-white/20">

        <p class="menu-label mb-2 px-3 text-[10px] font-bold uppercase tracking-widest text-[#838fb9]">
            Menu
        </p>

        <nav class="space-y-1">

            <a href="{{ url('/') }}"
                class="flex items-center gap-3 rounded-md px-3 py-2.5 transition-all
                {{ request()->is('/')
                    ? 'bg-white/10 text-white font-medium shadow-sm'
                    : 'text-[#abb9e8] hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="nav-text text-[13.5px] font-medium">Dashboard</span>
            </a>

            <a href="{{ url('/student') }}"
                class="flex items-center gap-3 rounded-md px-3 py-2.5 transition-all
                {{ request()->is('student*')
                    ? 'bg-white/10 text-white font-medium shadow-sm'
                    : 'text-[#abb9e8] hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined">groups</span>
                <span class="nav-text text-[13.5px] font-medium">Students</span>
            </a>

            <a href="{{ url('/staff') }}"
                class="flex items-center gap-3 rounded-md px-3 py-2.5 transition-all
                {{ request()->is('staff*')
                    ? 'bg-white/10 text-white font-medium shadow-sm'
                    : 'text-[#abb9e8] hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined">badge</span>
                <span class="nav-text text-[13.5px] font-medium">Staff</span>
            </a>

            <a href="{{ url('/academics') }}"
                class="flex items-center gap-3 rounded-md px-3 py-2.5 transition-all
                {{ request()->is('academics*')
                    ? 'bg-white/10 text-white font-medium shadow-sm'
                    : 'text-[#abb9e8] hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined">school</span>
                <span class="nav-text text-[13.5px] font-medium">Academics</span>
            </a>

            <a href="{{ url('/finance') }}"
                class="flex items-center gap-3 rounded-md px-3 py-2.5 transition-all
                {{ request()->is('finance*')
                    ? 'bg-white/10 text-white font-medium shadow-sm'
                    : 'text-[#abb9e8] hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined">payments</span>
                <span class="nav-text text-[13.5px] font-medium">Finance</span>
            </a>

            <a href="{{ url('/communications') }}"
                class="flex items-center gap-3 rounded-md px-3 py-2.5 transition-all
                {{ request()->is('communications*')
                    ? 'bg-white/10 text-white font-medium shadow-sm'
                    : 'text-[#abb9e8] hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined">campaign</span>
                <span class="nav-text text-[13.5px] font-medium">Communications</span>
            </a>

            <a href="{{ url('/reports') }}"
                class="flex items-center gap-3 rounded-md px-3 py-2.5 transition-all
                {{ request()->is('reports*')
                    ? 'bg-white/10 text-white font-medium shadow-sm'
                    : 'text-[#abb9e8] hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined">bar_chart</span>
                <span class="nav-text text-[13.5px] font-medium">Reports</span>
            </a>

            <button @click="settingsOpen = !settingsOpen"
                class="w-full flex items-center justify-between gap-3 rounded-md px-3 py-2.5 transition-all mt-2
                {{ request()->is('settings*') ? 'text-white font-medium' : 'text-[#abb9e8] hover:bg-white/5 hover:text-white' }}">

                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined">settings</span>
                    <span class="nav-text text-[13.5px] font-medium">Settings</span>
                </div>

                <span class="material-symbols-outlined text-sm transition-transform"
                    :class="settingsOpen ? 'rotate-180' : ''">
                    expand_more
                </span>
            </button>

            <div x-show="settingsOpen" x-collapse class="ml-6 mt-1 space-y-1 border-l border-white/10 pl-2">

                <a href="{{ url('/settings/organization') }}"
                    class="flex items-center gap-2 rounded-md px-3 py-2 text-[13px] transition
                    {{ request()->is('settings/organization*')
                        ? 'bg-white/10 text-white font-medium'
                        : 'text-[#abb9e8] hover:text-white hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-[18px]">apartment</span>
                    Organization Settings
                </a>

                <a href="{{ url('/settings/academics') }}"
                    class="flex items-center gap-2 rounded-md px-3 py-2 text-[13px] transition
                    {{ request()->is('settings/academics*')
                        ? 'bg-white/10 text-white font-medium'
                        : 'text-[#abb9e8] hover:text-white hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-[18px]">school</span>
                    Academic Settings
                </a>

                <a href="{{ url('/settings/users') }}"
                    class="flex items-center gap-2 rounded-md px-3 py-2 text-[13px] transition
                    {{ request()->is('settings/users*')
                        ? 'bg-white/10 text-white font-medium'
                        : 'text-[#abb9e8] hover:text-white hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-[18px]">group</span>
                    User & Role Management
                </a>

                <a href="{{ url('/settings/notifications') }}"
                    class="flex items-center gap-2 rounded-md px-3 py-2 text-[13px] transition
                    {{ request()->is('settings/notifications*')
                        ? 'bg-white/10 text-white font-medium'
                        : 'text-[#abb9e8] hover:text-white hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-[18px]">notifications</span>
                    Notifications & Alerts
                </a>

                <a href="{{ url('/settings/security') }}"
                    class="flex items-center gap-2 rounded-md px-3 py-2 text-[13px] transition
                    {{ request()->is('settings/security*')
                        ? 'bg-white/10 text-white font-medium'
                        : 'text-[#abb9e8] hover:text-white hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-[18px]">lock</span>
                    Security & Access
                </a>

                <a href="{{ url('/settings/integrations') }}"
                    class="flex items-center gap-2 rounded-md px-3 py-2 text-[13px] transition
                    {{ request()->is('settings/integrations*')
                        ? 'bg-white/10 text-white font-medium'
                        : 'text-[#abb9e8] hover:text-white hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-[18px]">hub</span>
                    Integrations
                </a>

                <a href="{{ url('/settings/system') }}"
                    class="flex items-center gap-2 rounded-md px-3 py-2 text-[13px] transition
                    {{ request()->is('settings/system*')
                        ? 'bg-white/10 text-white font-medium'
                        : 'text-[#abb9e8] hover:text-white hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-[18px]">tune</span>
                    System Preferences
                </a>

            </div>

        </nav>
    </div>

    <div class="sidebar-footer border-t border-white/10 p-4">
        <div class="flex items-center gap-3 rounded-lg bg-white/5 p-2">
            <div class="size-8 rounded bg-gray-600 flex items-center justify-center text-white font-bold text-xs">
                PS
            </div>
            <div class="min-w-0 flex-1">
                <p class="truncate text-xs font-bold text-white">
                    Principal Smith
                </p>
                <p class="truncate text-[10px] text-gray-400">
                    Administrator
                </p>
            </div>
        </div>
    </div>

</aside>

{{-- SCRIPT TO REMEMBER SCROLL POSITION --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.getElementById('sidebar-scroll-container');
        if (!sidebar) return;

        // 1. Restore scroll position on load
        const scrollPos = localStorage.getItem('sidebar_scroll_pos');
        if (scrollPos) sidebar.scrollTop = scrollPos;

        // 2. Save scroll position whenever user scrolls
        sidebar.addEventListener('scroll', () => {
            localStorage.setItem('sidebar_scroll_pos', sidebar.scrollTop);
        });
    });
</script>
