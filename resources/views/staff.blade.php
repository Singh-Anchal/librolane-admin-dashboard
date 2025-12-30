@extends('layouts.app')

@section('title', 'Teachers & Staff')

@section('content')
    {{-- 1. LOAD ALPINE JS --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    {{-- 2. STYLES --}}
    @push('styles')
        <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600;700&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
        <style>
            .font-display {
                font-family: 'Lexend', sans-serif;
            }

            .material-symbols-outlined {
                font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            }
        </style>
    @endpush

    <div class="font-display flex flex-col gap-6 p-4 bg-gray-50/50 min-h-screen">

        {{-- 1. HEADER SECTION --}}
        <div class="flex flex-wrap justify-between gap-4 items-center">
            <div class="flex flex-col">
                <h1 class="text-3xl font-bold text-slate-900">Teachers</h1>
                <p class="text-slate-500 text-sm">Manage teaching staff and departments</p>
            </div>

            <button
                class="flex items-center justify-center h-10 px-4 rounded-lg bg-[#2b8cee] text-white text-sm font-medium gap-2 hover:bg-blue-600 transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[20px]">add</span>
                <span>Add Teacher</span>
            </button>
        </div>

        {{-- 2. TOOLBAR (Search & Filters) --}}
        <div
            class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex flex-col lg:flex-row gap-4 justify-between items-center">

            {{-- Search Input --}}
            <div class="relative w-full lg:w-96">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="material-symbols-outlined text-slate-400 text-[20px]">search</span>
                </div>
                <input type="text"
                    class="block w-full pl-10 pr-3 py-2.5 border border-slate-200 rounded-lg bg-slate-50 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-[#2b8cee] focus:border-[#2b8cee] sm:text-sm"
                    placeholder="Search by name or subject...">
            </div>

            {{-- Right Side Filters --}}
            <div class="flex flex-wrap gap-3 w-full lg:w-auto items-center justify-end">

                {{-- Filter Icon --}}
                <span class="material-symbols-outlined text-slate-400 hidden sm:block">filter_list</span>

                {{-- Department Filter --}}
                <div class="relative">
                    <select
                        class="appearance-none pl-3 pr-8 py-2.5 border border-slate-200 rounded-lg text-sm font-medium text-slate-700 bg-white hover:bg-slate-50 focus:outline-none cursor-pointer">
                        <option>All Departments</option>
                        <option>Mathematics</option>
                        <option>Science</option>
                        <option>Languages</option>
                        <option>Humanities</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-500">
                        <span class="material-symbols-outlined text-[20px]">expand_more</span>
                    </div>
                </div>

                {{-- Status Filter --}}
                <div class="relative">
                    <select
                        class="appearance-none pl-3 pr-8 py-2.5 border border-slate-200 rounded-lg text-sm font-medium text-slate-700 bg-white hover:bg-slate-50 focus:outline-none cursor-pointer">
                        <option>Status: All</option>
                        <option>Active</option>
                        <option>On Leave</option>
                        <option>Resigned</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-500">
                        <span class="material-symbols-outlined text-[20px]">expand_more</span>
                    </div>
                </div>

                {{-- Export Button --}}
                <button
                    class="flex items-center justify-center px-4 py-2.5 border border-slate-200 rounded-lg text-sm font-medium text-slate-700 bg-white hover:bg-slate-50 gap-2 transition-colors">
                    <span class="material-symbols-outlined text-[20px]">download</span>
                    <span class="hidden sm:inline">Export</span>
                </button>
            </div>
        </div>

        {{-- 3. TEACHER CARDS GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            @php
                $teachers = [
                    [
                        'initials' => 'AF',
                        'bg_color' => 'bg-emerald-100',
                        'text_color' => 'text-emerald-700',
                        'name' => 'Dr. Ahmad Fahad',
                        'role' => 'Mathematics',
                        'department' => 'Science',
                        'exp' => '12 years',
                        'status' => 'Active',
                        'email' => 'ahmad.f@school.edu',
                        'phone' => '555-0201',
                    ],
                    [
                        'initials' => 'LN',
                        'bg_color' => 'bg-cyan-100',
                        'text_color' => 'text-cyan-700',
                        'name' => 'Mrs. Layla Nasser',
                        'role' => 'English',
                        'department' => 'Languages',
                        'exp' => '8 years',
                        'status' => 'Active',
                        'email' => 'layla.n@school.edu',
                        'phone' => '555-0202',
                    ],
                    [
                        'initials' => 'TI',
                        'bg_color' => 'bg-emerald-100',
                        'text_color' => 'text-emerald-700',
                        'name' => 'Mr. Tariq Ismail',
                        'role' => 'History',
                        'department' => 'Humanities',
                        'exp' => '10 years',
                        'status' => 'On Leave',
                        'email' => 'tariq.i@school.edu',
                        'phone' => '555-0205',
                    ],
                    [
                        'initials' => 'HO',
                        'bg_color' => 'bg-cyan-100',
                        'text_color' => 'text-cyan-700',
                        'name' => 'Mr. Hassan Omar',
                        'role' => 'Physics',
                        'department' => 'Science',
                        'exp' => '15 years',
                        'status' => 'Active',
                        'email' => 'hassan.o@school.edu',
                        'phone' => '555-0203',
                    ],
                    [
                        'initials' => 'NA',
                        'bg_color' => 'bg-emerald-100',
                        'text_color' => 'text-emerald-700',
                        'name' => 'Ms. Noor Ahmed',
                        'role' => 'Chemistry',
                        'department' => 'Science',
                        'exp' => '6 years',
                        'status' => 'Active',
                        'email' => 'noor.a@school.edu',
                        'phone' => '555-0204',
                    ],
                    [
                        'initials' => 'SY',
                        'bg_color' => 'bg-emerald-100',
                        'text_color' => 'text-emerald-700',
                        'name' => 'Mrs. Salma Youssef',
                        'role' => 'Biology',
                        'department' => 'Science',
                        'exp' => '9 years',
                        'status' => 'Active',
                        'email' => 'salma.y@school.edu',
                        'phone' => '555-0206',
                    ],
                ];
            @endphp

            @foreach ($teachers as $teacher)
                <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition-shadow">

                    {{-- Card Header --}}
                    <div class="flex justify-between items-start mb-6">
                        <div class="flex gap-4">
                            <div
                                class="h-12 w-12 rounded-full {{ $teacher['bg_color'] }} {{ $teacher['text_color'] }} flex items-center justify-center text-sm font-bold">
                                {{ $teacher['initials'] }}
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900 text-lg">{{ $teacher['name'] }}</h3>
                                <p class="text-slate-500 text-sm">{{ $teacher['role'] }}</p>
                            </div>
                        </div>

                        {{-- Three Dot Menu --}}
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" @click.outside="open = false"
                                class="text-slate-400 hover:text-slate-600 p-1 rounded-md hover:bg-slate-50">
                                <span class="material-symbols-outlined">more_horiz</span>
                            </button>
                            <div x-show="open" x-transition
                                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-slate-100 z-10"
                                style="display: none;">
                                <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">View
                                    Profile</a>
                                <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Assign
                                    Class</a>
                                <div class="h-px bg-slate-100 my-1"></div>
                                <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Delete</a>
                            </div>
                        </div>
                    </div>

                    {{-- Stats Grid --}}
                    <div class="grid grid-cols-2 gap-y-4 text-sm mb-6 border-b border-slate-100 pb-6">
                        <div>
                            <p class="text-slate-500 text-xs mb-1">Department</p>
                            <p class="font-medium text-slate-900">{{ $teacher['department'] }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-slate-500 text-xs mb-1">Experience</p>
                            <p class="font-medium text-slate-900">{{ $teacher['exp'] }}</p>
                        </div>
                        <div>
                            <p class="text-slate-500 text-xs mb-1">Status</p>
                            @if ($teacher['status'] === 'Active')
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold bg-emerald-50 text-emerald-600">
                                    Active
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold bg-amber-50 text-amber-600">
                                    On Leave
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Contact Footer --}}
                    <div class="space-y-2">
                        <div class="flex items-center gap-2 text-sm text-slate-500">
                            <span class="material-symbols-outlined text-[16px]">mail</span>
                            <span>{{ $teacher['email'] }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-slate-500">
                            <span class="material-symbols-outlined text-[16px]">call</span>
                            <span>{{ $teacher['phone'] }}</span>
                        </div>
                    </div>

                </div>
            @endforeach

        </div>

        {{-- 4. PAGINATION --}}
        <div class="flex items-center justify-between mt-4">
            <p class="text-sm text-slate-500">Showing <span class="font-bold text-slate-900">1-6</span> of <span
                    class="font-bold text-slate-900">42</span> teachers</p>
            <div class="flex gap-2">
                <button
                    class="px-4 py-2 text-sm border border-slate-200 rounded-lg text-slate-500 hover:bg-white bg-white/50 disabled:opacity-50 transition-colors">Previous</button>
                <button
                    class="px-4 py-2 text-sm border border-slate-200 rounded-lg text-slate-500 hover:bg-white bg-white/50 transition-colors">Next</button>
            </div>
        </div>

    </div>
@endsection
