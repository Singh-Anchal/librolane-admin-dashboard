@extends('layouts.app')

@section('title', 'Academic Calendar')

@section('content')

    {{-- 
        --------------------------------------------------------
        MOCK DATA & LOGIC (Frontend Only)
        --------------------------------------------------------
        We calculate the grid for January 2026 to match your image.
    --}}
    @php
        // Current View State
        $monthName = 'January';
        $year = 2026;
        $totalDays = 31; // Jan has 31 days
        $startDayOfWeek = 4; // Jan 1, 2026 is a Thursday (0=Sun, 4=Thu)

        // Mock Events
        // Types: 'holiday', 'exam', 'event', 'meeting'
        $events = [
            [
                'day' => 1,
                'title' => 'New Year\'s Day',
                'type' => 'holiday',
            ],
            [
                'day' => 15,
                'title' => 'Science Fair',
                'type' => 'event',
            ],
            [
                'day' => 22,
                'title' => 'Math Olympiad',
                'type' => 'exam',
            ],
            [
                'day' => 26,
                'title' => 'Republic Day',
                'type' => 'holiday',
            ],
        ];

        // Helper to check for event on a specific day
        function getEventForDay($day, $events)
        {
            foreach ($events as $event) {
                if ($event['day'] == $day) {
                    return $event;
                }
            }
            return null;
        }

        // Color mapping for event dots/backgrounds
        $colors = [
            'holiday' => 'bg-rose-500 text-rose-500',
            'exam' => 'bg-amber-400 text-amber-400',
            'event' => 'bg-emerald-500 text-emerald-500',
            'meeting' => 'bg-blue-500 text-blue-500',
        ];

        $lightColors = [
            'holiday' => 'bg-rose-50 border-rose-200 text-rose-700',
            'exam' => 'bg-amber-50 border-amber-200 text-amber-700',
            'event' => 'bg-emerald-50 border-emerald-200 text-emerald-700',
            'meeting' => 'bg-blue-50 border-blue-200 text-blue-700',
        ];
    @endphp

    <div class="min-h-screen bg-slate-50 dark:bg-[#101922] p-6 lg:p-8 font-sans text-slate-900 dark:text-white">

        {{-- 1. TOP HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">Academic Calendar</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Manage school events, holidays, and exam schedules
                </p>
            </div>

            <div class="flex items-center gap-3">
                {{-- Year Dropdown --}}
                <div class="relative">
                    <select
                        class="appearance-none bg-white dark:bg-[#18232f] border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 py-2 pl-4 pr-10 rounded-lg text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm cursor-pointer">
                        <option>2025-2026 Academic Year</option>
                        <option>2024-2025 Academic Year</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-500">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>

                {{-- Add Event Button --}}
                <button
                    class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-sm transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Event
                </button>
            </div>
        </div>

        {{-- 2. LEGEND --}}
        <div class="flex flex-wrap items-center gap-6 mb-6 text-sm">
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-rose-500 ring-2 ring-rose-100 dark:ring-rose-900"></span>
                <span class="text-slate-600 dark:text-slate-300 font-medium">Holiday</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-amber-400 ring-2 ring-amber-100 dark:ring-amber-900"></span>
                <span class="text-slate-600 dark:text-slate-300 font-medium">Exam</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-emerald-500 ring-2 ring-emerald-100 dark:ring-emerald-900"></span>
                <span class="text-slate-600 dark:text-slate-300 font-medium">Event</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-blue-500 ring-2 ring-blue-100 dark:ring-blue-900"></span>
                <span class="text-slate-600 dark:text-slate-300 font-medium">Meeting</span>
            </div>
        </div>

        {{-- 3. MAIN GRID LAYOUT --}}
        <div class="grid grid-cols-1 xl:grid-cols-4 gap-6">

            {{-- LEFT COLUMN: LARGE CALENDAR (Span 3) --}}
            <div
                class="xl:col-span-3 bg-white dark:bg-[#18232f] border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm p-6">

                {{-- Calendar Header --}}
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">{{ $monthName }} {{ $year }}
                    </h2>
                    <div class="flex gap-1">
                        <button
                            class="p-2 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg text-slate-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                                </path>
                            </svg>
                        </button>
                        <button
                            class="p-2 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg text-slate-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Days Header --}}
                <div class="grid grid-cols-7 mb-4">
                    @foreach (['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                        <div class="text-center text-sm font-medium text-slate-400 dark:text-slate-500">{{ $day }}
                        </div>
                    @endforeach
                </div>

                {{-- Calendar Grid Cells --}}
                <div
                    class="grid grid-cols-7 gap-px bg-slate-100 dark:bg-slate-800 border border-slate-100 dark:border-slate-800 rounded-xl overflow-hidden">

                    {{-- Empty Cells (Previous Month) --}}
                    @for ($i = 0; $i < $startDayOfWeek; $i++)
                        <div class="bg-white dark:bg-[#18232f] min-h-[120px] p-2"></div>
                    @endfor

                    {{-- Days of Month --}}
                    @for ($day = 1; $day <= $totalDays; $day++)
                        @php
                            $event = getEventForDay($day, $events);
                            $isSelected = $day == 5; // Simulating '5' as selected/current
                        @endphp

                        <div
                            class="relative bg-white dark:bg-[#18232f] min-h-[120px] p-3 transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/50 group cursor-pointer 
                            {{ $isSelected ? 'ring-1 ring-inset ring-emerald-500 bg-emerald-50/10 z-10' : '' }}">

                            {{-- Day Number --}}
                            <span
                                class="text-sm font-semibold {{ $isSelected ? 'text-emerald-600 dark:text-emerald-400' : 'text-slate-700 dark:text-slate-300' }}">
                                {{ $day }}
                            </span>

                            {{-- Event Label (If exists) --}}
                            @if ($event)
                                <div class="mt-2 text-xs p-1.5 rounded border truncate {{ $lightColors[$event['type']] }}">
                                    {{ $event['title'] }}
                                </div>
                            @endif

                            {{-- Add Button (Visible on Hover) --}}
                            <div class="absolute bottom-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <div
                                    class="w-6 h-6 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-400 hover:text-blue-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            {{-- RIGHT COLUMN: SIDEBAR WIDGETS (Span 1) --}}
            <div class="flex flex-col gap-6">

                {{-- Widget 1: Select a Date --}}
                <div
                    class="bg-white dark:bg-[#18232f] border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm p-6">
                    <h3 class="font-bold text-slate-900 dark:text-white mb-4">Select a Date</h3>
                    <div class="flex flex-col items-center justify-center py-6 text-center">
                        <div
                            class="w-12 h-12 bg-slate-50 dark:bg-slate-800 rounded-full flex items-center justify-center text-slate-400 mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Click on a date to view events.</p>
                    </div>
                </div>

                {{-- Widget 2: Upcoming Events --}}
                <div
                    class="bg-white dark:bg-[#18232f] border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm p-6">
                    <h3 class="font-bold text-slate-900 dark:text-white mb-4">Upcoming Events</h3>

                    @if (count($events) > 0)
                        <div class="space-y-4">
                            @foreach ($events as $event)
                                <div
                                    class="flex items-start gap-3 pb-3 border-b border-slate-50 dark:border-slate-800 last:border-0 last:pb-0">
                                    <div
                                        class="flex flex-col items-center justify-center w-10 h-10 rounded-lg bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shrink-0">
                                        <span class="text-xs font-bold text-slate-500 dark:text-slate-400">Jan</span>
                                        <span
                                            class="text-sm font-bold text-slate-900 dark:text-white">{{ $event['day'] }}</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-900 dark:text-white">
                                            {{ $event['title'] }}</p>
                                        <div class="flex items-center gap-1.5 mt-1">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $colors[$event['type']] }}"></span>
                                            <p class="text-xs text-slate-500 capitalize">{{ $event['type'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-slate-500">No upcoming events.</p>
                    @endif
                </div>

                {{-- Widget 3: Mini Calendar --}}
                <div
                    class="bg-white dark:bg-[#18232f] border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm p-6">

                    {{-- Mini Header --}}
                    <div class="flex items-center justify-between mb-4">
                        <button class="p-1 hover:bg-slate-100 rounded text-slate-400"><svg class="w-4 h-4" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7"></path>
                            </svg></button>
                        <span class="text-sm font-bold text-slate-900 dark:text-white">{{ $monthName }}
                            {{ $year }}</span>
                        <button class="p-1 hover:bg-slate-100 rounded text-slate-400"><svg class="w-4 h-4" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg></button>
                    </div>

                    {{-- Mini Grid --}}
                    <div class="grid grid-cols-7 text-center gap-y-2">
                        @foreach (['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'] as $day)
                            <span class="text-xs font-medium text-slate-400">{{ $day }}</span>
                        @endforeach

                        {{-- Empty Slots --}}
                        @for ($i = 0; $i < $startDayOfWeek; $i++)
                            <span></span>
                        @endfor

                        {{-- Days --}}
                        @for ($day = 1; $day <= $totalDays; $day++)
                            @php $isSelected = ($day == 5); @endphp
                            <div class="flex items-center justify-center">
                                <span
                                    class="w-7 h-7 flex items-center justify-center rounded-md text-sm cursor-pointer transition-colors
                                    {{ $isSelected
                                        ? 'bg-emerald-500 text-white shadow-sm'
                                        : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700' }}">
                                    {{ $day }}
                                </span>
                            </div>
                        @endfor
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
