@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    {{-- 1. Developer Tools Section --}}
    {{-- Changed shadow-sm to shadow-md --}}
    <div class="rounded-md bg-white p-6 shadow-md border border-v-primary/20">
        <h5 class="font-bold text-[#495057] mb-2">Developer Tools (Test Functions)</h5>
        <p class="text-xs text-gray-500 mb-4">Use these buttons to test the new Preloader and Toast notification system.</p>
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
            <button onclick="showLoader(500)"
                class="px-3 py-1.5 bg-v-primary text-white border border-v-primary text-xs font-bold rounded hover:bg-v-primary/90">Test
                Loader (0.5s)</button>
        </div>
    </div>

    {{-- 2. Stats Grid --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 mt-6">
        {{-- Card 1: Added shadow-md --}}
        <div class="flex items-center justify-between rounded-md bg-white p-5 shadow-md border-b-2 border-v-secondary/10">
            <div>
                <p class="text-[11px] font-bold text-[#878a99] uppercase tracking-wide">Total Students</p>
                <h4 class="mt-2 text-xl font-bold text-[#495057]">1,250</h4>
            </div>
            <div class="flex size-12 items-center justify-center rounded bg-v-secondary/10 text-v-secondary">
                <span class="material-symbols-outlined">groups</span>
            </div>
        </div>

        {{-- Card 2: Added shadow-md --}}
        <div class="flex items-center justify-between rounded-md bg-white p-5 shadow-md border-b-2 border-emerald-500/10">
            <div>
                <p class="text-[11px] font-bold text-[#878a99] uppercase tracking-wide">Total Staff</p>
                <h4 class="mt-2 text-xl font-bold text-[#495057]">85</h4>
            </div>
            <div class="flex size-12 items-center justify-center rounded bg-emerald-500/10 text-emerald-500">
                <span class="material-symbols-outlined">badge</span>
            </div>
        </div>

        {{-- Card 3: Added shadow-md --}}
        <div class="flex items-center justify-between rounded-md bg-white p-5 shadow-md border-b-2 border-amber-500/10">
            <div>
                <p class="text-[11px] font-bold text-[#878a99] uppercase tracking-wide">Attendance</p>
                <h4 class="mt-2 text-xl font-bold text-[#495057]">95%</h4>
            </div>
            <div class="flex size-12 items-center justify-center rounded bg-amber-500/10 text-amber-500">
                <span class="material-symbols-outlined">checklist</span>
            </div>
        </div>

        {{-- Card 4: Added shadow-md --}}
        <div class="flex items-center justify-between rounded-md bg-white p-5 shadow-md border-b-2 border-rose-500/10">
            <div>
                <p class="text-[11px] font-bold text-[#878a99] uppercase tracking-wide">On Leave</p>
                <h4 class="mt-2 text-xl font-bold text-[#495057]">4</h4>
            </div>
            <div class="flex size-12 items-center justify-center rounded bg-rose-500/10 text-rose-600">
                <span class="material-symbols-outlined">event_busy</span>
            </div>
        </div>
    </div>

    {{-- 3. Fee Chart & Right Side Announcements --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 mt-6">

        {{-- Fee Chart Container: Added shadow-md --}}
        <div class="lg:col-span-2 rounded-md bg-white p-6 shadow-md">
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
            {{-- Recent Announcements: Added shadow-md --}}
            <div class="rounded-md bg-white p-6 shadow-md">
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

            {{-- Upcoming Events: Added shadow-md --}}
            <div class="rounded-md bg-white p-6 shadow-md">
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

   {{-- 4. Quick Actions --}}
    <div class="rounded-md bg-white p-6 shadow-md mt-6">
        <h5 class="font-bold text-[#495057] mb-5">Quick Actions</h5>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            
            {{-- Button 1 --}}
            <button onclick="showToast('Opening Student Form...', 'info'); showLoader(500);"
                class="flex items-center gap-3 rounded border border-blue-100 bg-white p-3 shadow-md shadow-blue-200/50 hover:shadow-lg hover:shadow-blue-300 transition-all hover:-translate-y-0.5">
                <span class="material-symbols-outlined text-v-primary bg-blue-50 p-2 rounded shadow-sm">person_add</span>
                <span class="text-xs font-bold text-[#495057]">Add New Student</span>
            </button>

            {{-- Button 2 --}}
            <button
                class="flex items-center gap-3 rounded border border-blue-100 bg-white p-3 shadow-md shadow-blue-200/50 hover:shadow-lg hover:shadow-blue-300 transition-all hover:-translate-y-0.5">
                <span class="material-symbols-outlined text-v-primary bg-blue-50 p-2 rounded shadow-sm">groups</span>
                <span class="text-xs font-bold text-[#495057]">Manage Staff</span>
            </button>

            {{-- Button 3 --}}
            <button
                class="flex items-center gap-3 rounded border border-blue-100 bg-white p-3 shadow-md shadow-blue-200/50 hover:shadow-lg hover:shadow-blue-300 transition-all hover:-translate-y-0.5">
                <span class="material-symbols-outlined text-v-primary bg-blue-50 p-2 rounded shadow-sm">receipt_long</span>
                <span class="text-xs font-bold text-[#495057]">Fee Reports</span>
            </button>

            {{-- Button 4 --}}
            <button
                class="flex items-center gap-3 rounded border border-blue-100 bg-white p-3 shadow-md shadow-blue-200/50 hover:shadow-lg hover:shadow-blue-300 transition-all hover:-translate-y-0.5">
                <span class="material-symbols-outlined text-v-primary bg-blue-50 p-2 rounded shadow-sm">calendar_month</span>
                <span class="text-xs font-bold text-[#495057]">Academic Calendar</span>
            </button>

        </div>
    </div>

@endsection
