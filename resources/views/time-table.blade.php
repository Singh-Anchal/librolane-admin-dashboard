@extends('layouts.app')

@section('title', 'Timetable & Substitution')

@section('content')
    {{-- Alpine JS for interactivity --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    @php
        // --- MOCK DATA ---
        
        // 1. Time Slots
        $timeSlots = ['08:00 - 08:45', '08:45 - 09:30', '09:30 - 10:15', '10:15 - 10:45 (Break)', '10:45 - 11:30', '11:30 - 12:15'];
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

        // 2. The Timetable Data (Subject, Teacher, Color)
        // In a real app, this is fetched via DB based on Class ID
        $schedule = [
            '08:00 - 08:45' => [
                'Monday' => ['subject' => 'Mathematics', 'teacher' => 'Mr. R. Sharma', 'color' => 'bg-blue-50 border-blue-200 text-blue-700', 'status' => 'active'],
                'Tuesday' => ['subject' => 'English', 'teacher' => 'Ms. Sarah J.', 'color' => 'bg-emerald-50 border-emerald-200 text-emerald-700', 'status' => 'active'],
                'Wednesday' => ['subject' => 'Hindi', 'teacher' => 'Mr. V. Kumar', 'color' => 'bg-amber-50 border-amber-200 text-amber-700', 'status' => 'absent'], // Simulating Absent
                'Thursday' => ['subject' => 'Science', 'teacher' => 'Mrs. P. Gupta', 'color' => 'bg-purple-50 border-purple-200 text-purple-700', 'status' => 'active'],
                'Friday' => ['subject' => 'Math', 'teacher' => 'Mr. R. Sharma', 'color' => 'bg-blue-50 border-blue-200 text-blue-700', 'status' => 'active'],
            ],
            // ... truncated for brevity, logic handles the rest visually
        ];

        // 3. Mock "Free Teachers" logic
        // This simulates a query: SELECT * FROM teachers WHERE id NOT IN (SELECT teacher_id FROM timetables WHERE time = '09:00')
        $freeTeachers = [
            ['name' => 'Mrs. Anjali (Art)', 'load' => '2/6 periods'],
            ['name' => 'Mr. David (PE)', 'load' => '3/6 periods'],
            ['name' => 'Ms. Kavita (Library)', 'load' => '1/6 periods'],
        ];
    @endphp

    <div x-data="{ 
        selectedSlot: null, 
        selectedDay: null,
        showSubPanel: false,
        openSubstitution(day, time, subject) {
            this.selectedDay = day;
            this.selectedSlot = time;
            this.showSubPanel = true;
        }
    }" class="min-h-screen bg-slate-50 dark:bg-[#101922] p-6 font-sans text-slate-900 dark:text-white">

        {{-- HEADER & FILTERS --}}
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold tracking-tight">Class Timetable</h1>
                <p class="text-sm text-slate-500 mt-1">Manage schedules and assign substitute teachers.</p>
            </div>

            <div class="flex flex-wrap gap-3 bg-white dark:bg-[#18232f] p-2 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm">
                {{-- Class Selector --}}
                <div class="relative">
                    <label class="absolute -top-2 left-2 px-1 bg-white dark:bg-[#18232f] text-[10px] font-bold text-blue-600">Class</label>
                    <select class="h-10 pl-3 pr-8 rounded-lg border-0 bg-slate-50 dark:bg-slate-800 text-sm font-semibold focus:ring-2 focus:ring-blue-500 cursor-pointer">
                        <option>Grade 10-A</option>
                        <option>Grade 9-B</option>
                        <option>Grade 5-C</option>
                        <option>UKG - Rose</option>
                        <option>LKG - Lily</option>
                    </select>
                </div>

                {{-- View Mode --}}
                <div class="flex bg-slate-100 dark:bg-slate-800 rounded-lg p-1">
                    <button class="px-3 py-1.5 text-xs font-bold bg-white dark:bg-slate-600 shadow rounded-md">Class View</button>
                    <button class="px-3 py-1.5 text-xs font-medium text-slate-500 dark:text-slate-400 hover:text-slate-700">Teacher View</button>
                </div>

                <button class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 rounded-lg text-sm font-bold transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Print
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-4 gap-6">

            {{-- LEFT: TIMETABLE GRID (Span 3) --}}
            <div class="xl:col-span-3 overflow-x-auto rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm bg-white dark:bg-[#18232f]">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="p-4 border-b border-r border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-[#1e2a3b] min-w-[120px]">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Time / Day</span>
                            </th>
                            @foreach($days as $day)
                                <th class="p-4 border-b border-slate-100 dark:border-slate-800 min-w-[160px]">
                                    <span class="text-sm font-bold text-slate-700 dark:text-slate-200 uppercase">{{ $day }}</span>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($timeSlots as $slot)
                            <tr class="group">
                                {{-- Time Column --}}
                                <td class="p-4 border-r border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-[#1e2a3b]/50 text-xs font-bold text-slate-500">
                                    {{ $slot }}
                                </td>

                                @if(str_contains($slot, 'Break'))
                                    {{-- Break Row --}}
                                    <td colspan="5" class="p-2 border-b border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50">
                                        <div class="flex justify-center items-center h-full">
                                            <span class="px-3 py-1 rounded-full bg-slate-200 dark:bg-slate-700 text-xs font-bold text-slate-500 uppercase tracking-widest">Break Time</span>
                                        </div>
                                    </td>
                                @else
                                    {{-- Class Slots --}}
                                    @foreach($days as $index => $day)
                                        @php
                                            // Mocking Logic for Display
                                            $info = $schedule['08:00 - 08:45']['Monday']; // Default fallback
                                            if(isset($schedule[$slot][$day])) {
                                                $info = $schedule[$slot][$day];
                                            } elseif($index % 2 == 0) {
                                                $info = ['subject' => 'Science', 'teacher' => 'Mrs. P. Gupta', 'color' => 'bg-purple-50 border-purple-200 text-purple-700', 'status' => 'active'];
                                            } else {
                                                $info = ['subject' => 'History', 'teacher' => 'Mr. A. Khan', 'color' => 'bg-rose-50 border-rose-200 text-rose-700', 'status' => 'active'];
                                            }

                                            // Simulate a specific Absent Teacher scenario (Wed 09:30)
                                            if($day === 'Wednesday' && $slot === '08:00 - 08:45') {
                                                 $info = ['subject' => 'Hindi', 'teacher' => 'Mr. V. Kumar', 'color' => 'bg-red-50 border-red-200 text-red-700', 'status' => 'absent'];
                                            }
                                        @endphp

                                        <td class="p-2 border-b border-slate-100 dark:border-slate-800 relative h-24 align-top">
                                            @if($info['status'] === 'absent')
                                                {{-- ABSENT TEACHER CARD --}}
                                                <div class="h-full w-full rounded-xl border border-dashed border-red-300 bg-red-50 p-3 flex flex-col justify-between cursor-pointer hover:bg-red-100 transition-colors"
                                                     @click="openSubstitution('{{ $day }}', '{{ $slot }}', '{{ $info['subject'] }}')">
                                                    <div>
                                                        <div class="flex justify-between items-start">
                                                            <span class="text-xs font-bold text-red-600">{{ $info['subject'] }}</span>
                                                            <span class="h-1.5 w-1.5 rounded-full bg-red-500 animate-pulse"></span>
                                                        </div>
                                                        <div class="mt-1 text-xs font-medium text-red-800 line-through decoration-red-500">{{ $info['teacher'] }}</div>
                                                    </div>
                                                    <div class="mt-2 flex items-center gap-1 text-[10px] font-bold text-red-600 bg-white/50 w-fit px-1.5 py-0.5 rounded">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                                        Find Sub
                                                    </div>
                                                </div>
                                            @else
                                                {{-- NORMAL CLASS CARD --}}
                                                <div class="h-full w-full rounded-xl border {{ $info['color'] }} p-3 flex flex-col justify-between hover:shadow-md transition-shadow">
                                                    <div>
                                                        <div class="text-xs font-bold opacity-70">{{ $info['subject'] }}</div>
                                                        <div class="text-xs font-bold mt-1">{{ $info['teacher'] }}</div>
                                                    </div>
                                                    <div class="text-[10px] opacity-60">Room 101</div>
                                                </div>
                                            @endif
                                        </td>
                                    @endforeach
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- RIGHT: SUBSTITUTION SIDEBAR --}}
            <div class="flex flex-col gap-6">

                {{-- Widget 1: Today's Absentees --}}
                <div class="bg-white dark:bg-[#18232f] p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
                    <h3 class="font-bold text-slate-800 dark:text-white mb-4">Today's Absent Teachers</h3>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 p-3 bg-red-50 dark:bg-red-900/20 rounded-xl border border-red-100 dark:border-red-800">
                            <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center text-red-600 font-bold text-xs">VK</div>
                            <div>
                                <p class="text-sm font-bold text-slate-800 dark:text-white">Mr. V. Kumar</p>
                                <p class="text-xs text-red-500">Hindi • Sick Leave</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 p-3 bg-red-50 dark:bg-red-900/20 rounded-xl border border-red-100 dark:border-red-800">
                            <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center text-red-600 font-bold text-xs">AS</div>
                            <div>
                                <p class="text-sm font-bold text-slate-800 dark:text-white">Mrs. A. Singh</p>
                                <p class="text-xs text-red-500">Math • Personal</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Widget 2: DYNAMIC SUBSTITUTION PANEL (Alpine controlled) --}}
                <div class="bg-blue-600 p-6 rounded-2xl shadow-lg text-white relative overflow-hidden min-h-[300px]"
                     x-show="showSubPanel"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-x-4"
                     x-transition:enter-end="opacity-100 translate-x-0">
                    
                    {{-- Decorative Circle --}}
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>

                    <div class="relative z-10">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="font-bold text-lg">Substitution Needed</h3>
                            <button @click="showSubPanel = false" class="text-white/70 hover:text-white"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                        </div>

                        {{-- Selected Slot Details --}}
                        <div class="bg-white/10 rounded-xl p-3 mb-6 backdrop-blur-sm border border-white/10">
                            <div class="flex justify-between text-xs text-blue-200 mb-1">
                                <span x-text="selectedDay"></span>
                                <span x-text="selectedSlot"></span>
                            </div>
                            <div class="font-bold text-lg" x-text="subject || 'Hindi Class'"></div>
                            <div class="text-xs text-white/80">Class 10-A • Room 101</div>
                        </div>

                        <h4 class="font-bold text-sm mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Available Teachers
                        </h4>
                        
                        {{-- List of FREE teachers for that time slot --}}
                        <div class="space-y-2 max-h-[200px] overflow-y-auto pr-1 custom-scrollbar">
                            @foreach($freeTeachers as $teacher)
                            <div class="flex items-center justify-between p-2.5 bg-white rounded-lg text-slate-800 shadow-sm cursor-pointer hover:bg-blue-50 transition-colors">
                                <div class="flex items-center gap-2">
                                    <div class="h-8 w-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold">
                                        {{ substr($teacher['name'], 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold">{{ $teacher['name'] }}</p>
                                        <p class="text-[10px] text-slate-500">Load: {{ $teacher['load'] }}</p>
                                    </div>
                                </div>
                                <button class="p-1.5 bg-blue-600 text-white rounded hover:bg-blue-700">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                </button>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Placeholder if no slot selected --}}
                <div x-show="!showSubPanel" class="bg-slate-50 dark:bg-[#18232f] border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-2xl p-8 flex flex-col items-center justify-center text-center min-h-[300px]">
                    <div class="h-12 w-12 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 mb-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                    </div>
                    <h3 class="font-bold text-slate-400">Substitution Assistant</h3>
                    <p class="text-xs text-slate-400 mt-2">Click on any <span class="text-red-400 font-bold">Absent</span> card in the timetable to find available teachers for that period.</p>
                </div>

            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 10px;
        }
    </style>
@endsection