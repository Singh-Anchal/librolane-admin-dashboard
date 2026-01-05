@extends('layouts.app')

@section('title', 'Finance Overview')

@section('content')
    {{-- 1. LOAD SCRIPTS & FONTS --}}
    {{-- Alpine.js is required for the clickable buttons to work --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    @push('styles')
        {{-- Font: DM Sans --}}
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet" />

        <style>
            body {
                font-family: 'DM Sans', sans-serif;
                background-color: #f8fafc;
                /* Slate-50 background */
            }

            /* Hides scrollbar for sleek look in tables */
            .no-scrollbar::-webkit-scrollbar {
                display: none;
            }

            /* CSS Donut Chart Construction */
            .donut-chart {
                width: 180px;
                height: 180px;
                border-radius: 50%;
                background: conic-gradient(#3b82f6 0% 45%,
                        /* UPI - Blue */
                        #22c55e 45% 65%,
                        /* Cash - Green */
                        #eab308 65% 90%,
                        /* Card - Yellow */
                        #a855f7 90% 100%
                        /* Bank - Purple */
                    );
                position: relative;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            /* Inner White Circle to create the 'Donut' hole */
            .donut-chart::after {
                content: "";
                position: absolute;
                width: 120px;
                height: 120px;
                background: white;
                border-radius: 50%;
            }

            /* Text inside the donut */
            .chart-text {
                position: absolute;
                z-index: 10;
                text-align: center;
            }
        </style>
    @endpush

    <div class="w-full flex flex-col gap-8 p-4 md:p-8 min-h-screen text-slate-800">

        {{-- 1. HEADER & TIME FILTER --}}
        <div class="flex flex-col xl:flex-row justify-between items-start xl:items-center gap-4">

            {{-- Time Toggles (NOW CLICKABLE using Alpine.js) --}}
            <div class="bg-white p-1.5 rounded-xl border border-slate-200 flex shadow-sm overflow-x-auto max-w-full"
                x-data="{ activeFilter: 'Monthly' }">

                <button @click="activeFilter = 'Daily'"
                    :class="activeFilter === 'Daily' ? 'bg-blue-600 text-white font-bold shadow-md' :
                        'text-slate-500 font-medium hover:text-slate-800 hover:bg-slate-50'"
                    class="px-5 py-2 text-sm rounded-lg transition-all duration-200 whitespace-nowrap">
                    Daily
                </button>

                <button @click="activeFilter = 'Weekly'"
                    :class="activeFilter === 'Weekly' ? 'bg-blue-600 text-white font-bold shadow-md' :
                        'text-slate-500 font-medium hover:text-slate-800 hover:bg-slate-50'"
                    class="px-5 py-2 text-sm rounded-lg transition-all duration-200 whitespace-nowrap">
                    Weekly
                </button>

                <button @click="activeFilter = 'Monthly'"
                    :class="activeFilter === 'Monthly' ? 'bg-blue-600 text-white font-bold shadow-md' :
                        'text-slate-500 font-medium hover:text-slate-800 hover:bg-slate-50'"
                    class="px-5 py-2 text-sm rounded-lg transition-all duration-200 whitespace-nowrap">
                    Monthly
                </button>

                <button @click="activeFilter = 'Yearly'"
                    :class="activeFilter === 'Yearly' ? 'bg-blue-600 text-white font-bold shadow-md' :
                        'text-slate-500 font-medium hover:text-slate-800 hover:bg-slate-50'"
                    class="px-5 py-2 text-sm rounded-lg transition-all duration-200 whitespace-nowrap">
                    Yearly
                </button>
            </div>

            {{-- Action Buttons --}}
            <div class="flex flex-wrap gap-3">
                <button
                    class="flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                    Refresh
                </button>
                <button
                    class="flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-bold hover:bg-blue-700 shadow-lg shadow-blue-200 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Export
                </button>
            </div>
        </div>

        {{-- 2. MAIN STATS ROW (RESPONSIVE FIXED) --}}
        {{-- Mobile: 1 col, Tablet: 2 cols, Desktop: 4 cols --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">

            {{-- Card 1: Collection --}}
            <div
                class="bg-white p-5 rounded-3xl border border-slate-100 shadow-sm flex flex-col justify-center gap-2 hover:shadow-md transition-shadow">
                <p class="text-sm font-semibold text-slate-500 whitespace-nowrap">Today's Collection</p>
                <div class="flex flex-wrap items-baseline gap-3">
                    <h3 class="text-2xl sm:text-3xl font-bold text-slate-900">₹4,50,670</h3>
                    <span
                        class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold text-emerald-600 bg-emerald-50 border border-emerald-100">
                        +2.5%
                    </span>
                </div>
            </div>

            {{-- Card 2: Expenses --}}
            <div
                class="bg-white p-5 rounded-3xl border border-slate-100 shadow-sm flex flex-col justify-center gap-2 hover:shadow-md transition-shadow">
                <p class="text-sm font-semibold text-slate-500 whitespace-nowrap">Today's Expenses</p>
                <div class="flex flex-wrap items-baseline gap-3">
                    <h3 class="text-2xl sm:text-3xl font-bold text-slate-900">₹1,20,850</h3>
                    <span
                        class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold text-rose-600 bg-rose-50 border border-rose-100">
                        -1.2%
                    </span>
                </div>
            </div>

            {{-- Card 3: Net Balance --}}
            <div
                class="bg-white p-5 rounded-3xl border border-slate-100 shadow-sm flex flex-col justify-center gap-2 hover:shadow-md transition-shadow">
                <p class="text-sm font-semibold text-slate-500 whitespace-nowrap">Net Balance</p>
                <h3 class="text-2xl sm:text-3xl font-bold text-slate-900">₹3,29,820</h3>
            </div>

            {{-- Card 4: Pending Fees --}}
            <div
                class="bg-white p-5 rounded-3xl border border-slate-100 shadow-sm flex flex-col justify-center gap-2 border-l-4 border-l-slate-800 hover:shadow-md transition-shadow">
                <p class="text-sm font-semibold text-slate-500 whitespace-nowrap">Pending Fees</p>
                <h3 class="text-2xl sm:text-3xl font-bold text-slate-900">₹35,210</h3>
            </div>

        </div>

        {{-- 3. CHARTS SECTION --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- LEFT: Collections vs Expenses Bar Chart --}}
            <div class="xl:col-span-2 bg-white p-6 md:p-8 rounded-3xl border border-slate-100 shadow-sm">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="font-bold text-slate-900 text-lg md:text-xl">Collections vs Expenses</h3>
                    <div class="flex bg-slate-50 p-1 rounded-lg">
                        <button
                            class="px-3 md:px-4 py-1.5 text-xs font-medium text-slate-500 hover:text-slate-800 transition">Line</button>
                        <button
                            class="px-3 md:px-4 py-1.5 text-xs font-bold bg-white text-slate-900 rounded-md shadow-sm transition">Bar</button>
                    </div>
                </div>

                {{-- Chart Area --}}
                <div class="relative h-64 md:h-72 w-full flex items-end justify-between px-2 gap-2 md:gap-4">
                    {{-- Background Grid Lines --}}
                    <div
                        class="absolute inset-0 flex flex-col justify-between text-xs text-slate-300 pointer-events-none z-0">
                        <div class="border-b border-dashed border-slate-200 w-full h-0"></div>
                        <div class="border-b border-dashed border-slate-200 w-full h-0"></div>
                        <div class="border-b border-dashed border-slate-200 w-full h-0"></div>
                        <div class="border-b border-dashed border-slate-200 w-full h-0"></div>
                        <div class="border-b border-slate-300 w-full h-0"></div>
                    </div>

                    {{-- Bars Loop --}}
                    @foreach (['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'] as $index => $month)
                        @php
                            $h1 = rand(30, 80) . '%';
                            $h2 = rand(15, 50) . '%';
                        @endphp
                        <div class="flex flex-col items-center gap-2 flex-1 h-full justify-end z-10 group cursor-pointer">
                            <div class="flex items-end gap-1 h-full w-full justify-center">
                                <div class="w-3 md:w-6 bg-slate-800 rounded-t-sm md:rounded-t-md group-hover:bg-slate-700 transition-all shadow-sm"
                                    style="height: {{ $h1 }}"></div>
                                <div class="w-3 md:w-6 bg-blue-500 rounded-t-sm md:rounded-t-md group-hover:bg-blue-600 transition-all shadow-sm"
                                    style="height: {{ $h2 }}"></div>
                            </div>
                            <span class="text-[10px] md:text-xs font-bold text-slate-400">{{ $month }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- RIGHT: Payment Mode Breakdown Donut --}}
            <div class="bg-white p-6 md:p-8 rounded-3xl border border-slate-100 shadow-sm flex flex-col">
                <h3 class="font-bold text-slate-900 text-lg md:text-xl mb-8">Payment Mode Breakdown</h3>

                <div class="flex-1 flex flex-col items-center justify-center">
                    <div class="donut-chart mb-8 shadow-inner">
                        <div class="chart-text">
                            <p class="text-3xl font-bold text-slate-800">100%</p>
                            <p class="text-xs text-slate-400 uppercase tracking-wide font-bold">Total</p>
                        </div>
                    </div>

                    {{-- Legend Grid --}}
                    <div class="grid grid-cols-2 gap-x-4 md:gap-x-8 gap-y-4 md:gap-y-6 w-full px-2">
                        <div class="flex items-start gap-3">
                            <span class="w-3 h-3 rounded-full bg-blue-500 mt-1 shrink-0"></span>
                            <div>
                                <p class="text-sm font-bold text-slate-800">UPI</p>
                                <p class="text-xs text-slate-400">45%</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="w-3 h-3 rounded-full bg-green-500 mt-1 shrink-0"></span>
                            <div>
                                <p class="text-sm font-bold text-slate-800">Cash</p>
                                <p class="text-xs text-slate-400">20%</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="w-3 h-3 rounded-full bg-yellow-500 mt-1 shrink-0"></span>
                            <div>
                                <p class="text-sm font-bold text-slate-800">Card</p>
                                <p class="text-xs text-slate-400">25%</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="w-3 h-3 rounded-full bg-purple-500 mt-1 shrink-0"></span>
                            <div>
                                <p class="text-sm font-bold text-slate-800">Bank</p>
                                <p class="text-xs text-slate-400">10%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 4. RECENT TRANSACTIONS TABLE --}}
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden mt-8">
            <div class="px-6 md:px-8 py-6 border-b border-slate-100 flex justify-between items-center">
                <h3 class="font-bold text-slate-900 text-lg">Recent Transactions</h3>
                <button class="text-sm font-bold text-blue-600 hover:text-blue-700 hover:underline">View All</button>
            </div>

            {{-- Responsive Table Container --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead class="bg-slate-50 text-slate-500 text-xs uppercase font-bold tracking-wider">
                        <tr>
                            <th class="px-6 md:px-8 py-4">Student Name</th>
                            <th class="px-6 md:px-8 py-4">Purpose</th>
                            <th class="px-6 md:px-8 py-4">Payment Mode</th>
                            <th class="px-6 md:px-8 py-4 text-right">Amount</th>
                            <th class="px-6 md:px-8 py-4 text-right">Time</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        {{-- Row 1 --}}
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-6 md:px-8 py-5 font-bold text-slate-800">Olivia Chen</td>
                            <td class="px-6 md:px-8 py-5 text-slate-500 font-medium">Tuition Fee</td>
                            <td class="px-6 md:px-8 py-5">
                                <span
                                    class="inline-flex items-center gap-2 text-xs font-bold text-blue-700 bg-blue-50 px-3 py-1.5 rounded-lg">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> UPI
                                </span>
                            </td>
                            <td class="px-6 md:px-8 py-5 text-right font-bold text-slate-900">₹1,200.00</td>
                            <td class="px-6 md:px-8 py-5 text-right text-slate-400 font-medium text-xs">10:45 AM</td>
                        </tr>
                        {{-- Row 2 --}}
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-6 md:px-8 py-5 font-bold text-slate-800">Benjamin Carter</td>
                            <td class="px-6 md:px-8 py-5 text-slate-500 font-medium">Exam Fee</td>
                            <td class="px-6 md:px-8 py-5">
                                <span
                                    class="inline-flex items-center gap-2 text-xs font-bold text-yellow-700 bg-yellow-50 px-3 py-1.5 rounded-lg">
                                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-600"></span> Card
                                </span>
                            </td>
                            <td class="px-6 md:px-8 py-5 text-right font-bold text-slate-900">₹550.00</td>
                            <td class="px-6 md:px-8 py-5 text-right text-slate-400 font-medium text-xs">09:30 AM</td>
                        </tr>
                        {{-- Row 3 --}}
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-6 md:px-8 py-5 font-bold text-slate-800">Aarav Patel</td>
                            <td class="px-6 md:px-8 py-5 text-slate-500 font-medium">Books & Stationery</td>
                            <td class="px-6 md:px-8 py-5">
                                <span
                                    class="inline-flex items-center gap-2 text-xs font-bold text-emerald-700 bg-emerald-50 px-3 py-1.5 rounded-lg">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span> Cash
                                </span>
                            </td>
                            <td class="px-6 md:px-8 py-5 text-right font-bold text-slate-900">₹250.75</td>
                            <td class="px-6 md:px-8 py-5 text-right text-slate-400 font-medium text-xs">09:15 AM</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
