@extends('layouts.app')

@section('title', 'Academics Overview')

@section('content')
    {{-- Alpine JS for interactions --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    @push('styles')
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet" />
        <style>
            body {
                font-family: 'DM Sans', sans-serif;
                background-color: #f8fafc;
            }

            /* Hide scrollbar for clean look in widgets */
            .no-scrollbar::-webkit-scrollbar {
                display: none;
            }

            .no-scrollbar {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        </style>
    @endpush

    {{-- MAIN WRAPPER: w-full fixes sidebar overlap issues --}}
    <div class="w-full flex flex-col gap-6 p-4 md:p-8 min-h-screen text-slate-800 overflow-x-hidden">

        {{-- 1. HEADER SECTION (Responsive: Stack on Mobile, Row on Desktop) --}}
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-slate-900 tracking-tight">Academics Overview</h1>
                <p class="text-slate-500 text-sm mt-1">Manage curriculum, assessments, and teacher performance.</p>
            </div>

            <div class="flex flex-wrap items-center gap-3 w-full lg:w-auto">
                {{-- Search Bar --}}
                <div class="relative flex-grow lg:flex-grow-0 lg:w-64">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>
                    <input type="text" placeholder="Search..."
                        class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-100 shadow-sm">
                </div>

                {{-- Schedule Button --}}
                <button
                    class="flex items-center justify-center gap-2 px-4 py-2.5 bg-white border border-slate-200 text-slate-700 rounded-xl text-sm font-semibold hover:bg-slate-50 shadow-sm whitespace-nowrap flex-1 lg:flex-none">
                    <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <span>Schedule</span>
                </button>

                {{-- Add New Button --}}
                <button
                    class="flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-bold hover:bg-blue-700 shadow-md shadow-blue-200 whitespace-nowrap flex-1 lg:flex-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span>New Course</span>
                </button>
            </div>
        </div>

        {{-- 2. MAIN GRID LAYOUT --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 md:gap-8">

            {{-- LEFT COLUMN (Main Content) --}}
            <div class="xl:col-span-2 flex flex-col gap-6 md:gap-8">

                {{-- A. CARDS SECTION (Curriculum & Exams) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Curriculum Card --}}
                    <div class="bg-white p-5 md:p-6 rounded-3xl border border-slate-100 shadow-sm">
                        <h3 class="font-bold text-slate-800 mb-5">Curriculum Overview</h3>
                        <div class="space-y-4">
                            {{-- Item 1 --}}
                            <div
                                class="group flex items-center justify-between p-3 md:p-4 bg-slate-50 rounded-2xl hover:bg-blue-50 transition-colors cursor-pointer border border-transparent hover:border-blue-100">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="h-10 w-10 md:h-12 md:w-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <div
                                            class="font-bold text-slate-700 text-sm md:text-base group-hover:text-blue-700 truncate">
                                            Curriculum Plans</div>
                                        <div class="text-xs text-slate-400 group-hover:text-blue-500 truncate">View syllabus
                                            status</div>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-slate-300 group-hover:text-blue-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </div>
                            {{-- Item 2 --}}
                            <div
                                class="group flex items-center justify-between p-3 md:p-4 bg-slate-50 rounded-2xl hover:bg-blue-50 transition-colors cursor-pointer border border-transparent hover:border-blue-100">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="h-10 w-10 md:h-12 md:w-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <div
                                            class="font-bold text-slate-700 text-sm md:text-base group-hover:text-blue-700 truncate">
                                            Academic Standards</div>
                                        <div class="text-xs text-slate-400 group-hover:text-blue-500 truncate">Grading &
                                            criteria</div>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-slate-300 group-hover:text-blue-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Exam Card --}}
                    <div class="bg-white p-5 md:p-6 rounded-3xl border border-slate-100 shadow-sm">
                        <h3 class="font-bold text-slate-800 mb-5">Exam & Assessment</h3>
                        <div class="space-y-4">
                            {{-- Item 1 --}}
                            <div
                                class="group flex items-center justify-between p-3 md:p-4 bg-slate-50 rounded-2xl hover:bg-amber-50 transition-colors cursor-pointer border border-transparent hover:border-amber-100">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="h-10 w-10 md:h-12 md:w-12 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <div
                                            class="font-bold text-slate-700 text-sm md:text-base group-hover:text-amber-700 truncate">
                                            Exam Schedules</div>
                                        <div class="text-xs text-slate-400 group-hover:text-amber-600 truncate">Dates &
                                            Invigilators</div>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-slate-300 group-hover:text-amber-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                            {{-- Item 2 --}}
                            <div
                                class="group flex items-center justify-between p-3 md:p-4 bg-slate-50 rounded-2xl hover:bg-amber-50 transition-colors cursor-pointer border border-transparent hover:border-amber-100">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="h-10 w-10 md:h-12 md:w-12 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <div
                                            class="font-bold text-slate-700 text-sm md:text-base group-hover:text-amber-700 truncate">
                                            Manage Results</div>
                                        <div class="text-xs text-slate-400 group-hover:text-amber-600 truncate">Publish
                                            grades</div>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-slate-300 group-hover:text-amber-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- B. CHART SECTION (Responsive Height & Width) --}}
                <div class="bg-white p-6 md:p-8 rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                        <div>
                            <h3 class="font-bold text-slate-800 text-lg">Academic Performance Summaries</h3>
                            <p class="text-xs text-slate-400 mt-1">Average scores per subject</p>
                        </div>
                        <div class="flex bg-slate-100 p-1 rounded-lg shrink-0">
                            <button class="px-3 py-1 text-xs font-bold bg-white text-slate-900 rounded-md shadow-sm">By
                                Grade</button>
                            <button class="px-3 py-1 text-xs font-medium text-slate-500 hover:text-slate-700">By
                                Subject</button>
                        </div>
                    </div>

                    {{-- The Bars Container (Scrollable on mobile to prevent squishing) --}}
                    <div class="w-full overflow-x-auto no-scrollbar">
                        <div class="flex items-end justify-between gap-3 min-w-[500px] h-64 px-2 pb-2">
                            @php
                                $subjects = [
                                    [
                                        'name' => 'Math',
                                        'bg' => 'bg-[#22c55e]',
                                        'bg_light' => 'bg-[#22c55e]/10',
                                        'h' => '85%',
                                    ],
                                    [
                                        'name' => 'Science',
                                        'bg' => 'bg-[#3b82f6]',
                                        'bg_light' => 'bg-[#3b82f6]/10',
                                        'h' => '72%',
                                    ],
                                    [
                                        'name' => 'History',
                                        'bg' => 'bg-[#eab308]',
                                        'bg_light' => 'bg-[#eab308]/10',
                                        'h' => '90%',
                                    ],
                                    [
                                        'name' => 'English',
                                        'bg' => 'bg-[#ef4444]',
                                        'bg_light' => 'bg-[#ef4444]/10',
                                        'h' => '78%',
                                    ],
                                    [
                                        'name' => 'Art',
                                        'bg' => 'bg-[#a855f7]',
                                        'bg_light' => 'bg-[#a855f7]/10',
                                        'h' => '65%',
                                    ],
                                    [
                                        'name' => 'Music',
                                        'bg' => 'bg-[#6366f1]',
                                        'bg_light' => 'bg-[#6366f1]/10',
                                        'h' => '88%',
                                    ],
                                ];
                            @endphp

                            @foreach ($subjects as $sub)
                                <div class="flex flex-col items-center gap-3 flex-1 h-full group cursor-pointer">
                                    <div
                                        class="relative w-full rounded-t-xl {{ $sub['bg_light'] }} h-full flex items-end overflow-hidden">
                                        <div class="w-full {{ $sub['bg'] }} rounded-t-xl relative group-hover:opacity-90 transition-all duration-500"
                                            style="height: {{ $sub['h'] }};"></div>
                                    </div>
                                    <span class="text-xs font-bold text-slate-500">{{ $sub['name'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- C. TEACHER TABLE (Responsive Table) --}}
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-slate-800">Teacher Academic Oversight</h3>
                        <a href="#" class="text-xs font-bold text-blue-600 hover:underline">View All</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left whitespace-nowrap">
                            <thead>
                                <tr class="text-xs font-bold text-slate-400 uppercase border-b border-slate-100">
                                    <th class="pb-4 pl-2">Teacher</th>
                                    <th class="pb-4">Subject</th>
                                    <th class="pb-4">Avg. Score</th>
                                    <th class="pb-4 w-1/3">Syllabus</th>
                                    <th class="pb-4 text-right pr-2">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                <tr class="group hover:bg-slate-50 transition-colors">
                                    <td class="py-4 pl-2 font-bold text-slate-800">Mr. John Doe</td>
                                    <td class="py-4 text-slate-500">Mathematics</td>
                                    <td class="py-4 font-bold text-slate-800">88%</td>
                                    <td class="py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="h-1.5 w-24 bg-slate-100 rounded-full overflow-hidden">
                                                <div class="h-full bg-emerald-500 w-full rounded-full"></div>
                                            </div>
                                            <span class="text-xs font-bold text-emerald-600">100%</span>
                                        </div>
                                    </td>
                                    <td class="py-4 text-right pr-2">
                                        <svg class="w-5 h-5 text-slate-300 hover:text-blue-600 cursor-pointer inline-block"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </td>
                                </tr>
                                <tr class="group hover:bg-slate-50 transition-colors border-t border-slate-50">
                                    <td class="py-4 pl-2 font-bold text-slate-800">Ms. Jane Smith</td>
                                    <td class="py-4 text-slate-500">Science</td>
                                    <td class="py-4 font-bold text-slate-800">92%</td>
                                    <td class="py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="h-1.5 w-24 bg-slate-100 rounded-full overflow-hidden">
                                                <div class="h-full bg-emerald-500 w-full rounded-full"></div>
                                            </div>
                                            <span class="text-xs font-bold text-emerald-600">100%</span>
                                        </div>
                                    </td>
                                    <td class="py-4 text-right pr-2">
                                        <svg class="w-5 h-5 text-slate-300 hover:text-blue-600 cursor-pointer inline-block"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            {{-- RIGHT COLUMN (Sidebar Widgets) --}}
            <div class="flex flex-col gap-6 md:gap-8">

                {{-- D. CALENDAR --}}
                <div class="bg-white p-5 md:p-6 rounded-3xl border border-slate-100 shadow-sm">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-slate-800">Academic Calendar</h3>
                        <a href="#" class="text-xs font-bold text-blue-600 hover:underline">View All</a>
                    </div>

                    <div class="space-y-6 relative">
                        {{-- Timeline Line --}}
                        <div class="absolute left-[26px] top-4 bottom-4 w-px bg-slate-100 -z-10"></div>

                        {{-- Event 1 --}}
                        <div class="flex gap-4 group">
                            <div
                                class="h-14 w-14 flex-shrink-0 bg-red-50 rounded-2xl flex flex-col items-center justify-center border border-red-50 text-red-500 group-hover:bg-red-500 group-hover:text-white transition-all shadow-sm">
                                <span class="text-[10px] font-bold uppercase tracking-wider">Jul</span>
                                <span class="text-xl font-bold leading-none">25</span>
                            </div>
                            <div class="pt-1">
                                <h4 class="font-bold text-slate-800 text-sm group-hover:text-red-600 transition-colors">
                                    Mid-Term Exams Start</h4>
                                <p class="text-xs text-slate-400 mt-1">All Grades • 09:00 AM</p>
                            </div>
                        </div>

                        {{-- Event 2 --}}
                        <div class="flex gap-4 group">
                            <div
                                class="h-14 w-14 flex-shrink-0 bg-blue-50 rounded-2xl flex flex-col items-center justify-center border border-blue-50 text-blue-500 group-hover:bg-blue-500 group-hover:text-white transition-all shadow-sm">
                                <span class="text-[10px] font-bold uppercase tracking-wider">Aug</span>
                                <span class="text-xl font-bold leading-none">10</span>
                            </div>
                            <div class="pt-1">
                                <h4 class="font-bold text-slate-800 text-sm group-hover:text-blue-600 transition-colors">
                                    Parent-Teacher Meeting</h4>
                                <p class="text-xs text-slate-400 mt-1">Senior School • Hall A</p>
                            </div>
                        </div>

                        {{-- Event 3 --}}
                        <div class="flex gap-4 group">
                            <div
                                class="h-14 w-14 flex-shrink-0 bg-amber-50 rounded-2xl flex flex-col items-center justify-center border border-amber-50 text-amber-500 group-hover:bg-amber-500 group-hover:text-white transition-all shadow-sm">
                                <span class="text-[10px] font-bold uppercase tracking-wider">Sep</span>
                                <span class="text-xl font-bold leading-none">05</span>
                            </div>
                            <div class="pt-1">
                                <h4 class="font-bold text-slate-800 text-sm group-hover:text-amber-600 transition-colors">
                                    Teacher's Day</h4>
                                <p class="text-xs text-slate-400 mt-1">Auditorium</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- E. PENDING ACTIONS (Dark Mode Widget - Fixed Overlay) --}}
                <div
                    class="bg-slate-900 p-6 rounded-3xl shadow-xl text-white relative overflow-hidden flex flex-col h-auto">
                    {{-- Decorative Blur --}}
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-blue-500 rounded-full blur-[60px] opacity-20 pointer-events-none">
                    </div>

                    {{-- Header --}}
                    <div class="relative z-10 mb-6">
                        <div class="flex items-center gap-3 mb-1">
                            <div class="p-2 bg-amber-500/20 rounded-xl text-amber-400 border border-amber-500/10">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="font-bold text-lg">Pending Actions</h3>
                        </div>
                        <p class="text-slate-400 text-xs ml-1">5 items require review</p>
                    </div>

                    {{-- List --}}
                    <div class="relative z-10 space-y-4">
                        {{-- Item 1 --}}
                        <div
                            class="p-4 rounded-2xl bg-slate-800/50 border border-slate-700/50 hover:bg-slate-800 transition-all">
                            <div class="flex justify-between items-start mb-2">
                                <span
                                    class="text-[10px] font-bold uppercase bg-emerald-500/20 text-emerald-400 px-2 py-0.5 rounded-md">Results</span>
                                <span class="text-[10px] text-slate-500">2h ago</span>
                            </div>
                            <p class="text-sm font-medium text-slate-200 mb-4">Grade 10 Final Marks ready.</p>
                            <div class="grid grid-cols-2 gap-3">
                                <button
                                    class="py-2 bg-white text-slate-900 text-xs font-bold rounded-lg hover:bg-slate-200 transition-colors">Approve</button>
                                <button
                                    class="py-2 bg-transparent border border-slate-600 text-white text-xs font-bold rounded-lg hover:bg-slate-700 transition-colors">Review</button>
                            </div>
                        </div>

                        {{-- Item 2 --}}
                        <div
                            class="p-4 rounded-2xl bg-slate-800/50 border border-slate-700/50 hover:bg-slate-800 transition-all">
                            <div class="flex justify-between items-start mb-2">
                                <span
                                    class="text-[10px] font-bold uppercase bg-blue-500/20 text-blue-400 px-2 py-0.5 rounded-md">Syllabus</span>
                                <span class="text-[10px] text-slate-500">Yesterday</span>
                            </div>
                            <p class="text-sm font-medium text-slate-200 mb-4">History Dept syllabus update.</p>
                            <div class="grid grid-cols-2 gap-3">
                                <button
                                    class="py-2 bg-white text-slate-900 text-xs font-bold rounded-lg hover:bg-slate-200 transition-colors">Approve</button>
                                <button
                                    class="py-2 bg-transparent border border-slate-600 text-white text-xs font-bold rounded-lg hover:bg-slate-700 transition-colors">Review</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
