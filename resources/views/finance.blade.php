@extends('layouts.app')

@section('title', 'Finance Overview')

@section('content')
    {{-- 1. LOAD SCRIPTS & FONTS --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    @push('styles')
        {{-- Font: DM Sans (Matches the reference image perfectly) --}}
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet" />

        <style>
            body {
                font-family: 'DM Sans', sans-serif;
                background-color: #f8fafc;
            }

            .no-scrollbar::-webkit-scrollbar {
                display: none;
            }

            /* CSS Donut Chart (Replicates the visual) */
            .donut-chart {
                width: 180px;
                height: 180px;
                border-radius: 50%;
                /* Gradient matches the legend colors */
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

            /* Inner White Circle to make it a donut */
            .donut-chart::after {
                content: "";
                position: absolute;
                width: 120px;
                height: 120px;
                background: white;
                border-radius: 50%;
            }

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
            {{-- Time Toggles --}}
            <div class="bg-white p-1.5 rounded-xl border border-slate-200 flex shadow-sm overflow-x-auto">
                <button
                    class="px-5 py-2 text-sm font-medium text-slate-500 hover:text-slate-800 rounded-lg transition-colors">Daily</button>
                <button
                    class="px-5 py-2 text-sm font-medium text-slate-500 hover:text-slate-800 rounded-lg transition-colors">Weekly</button>
                <button
                    class="px-5 py-2 text-sm font-bold text-white bg-blue-600 rounded-lg shadow-md transition-colors">Monthly</button>
                <button
                    class="px-5 py-2 text-sm font-medium text-slate-500 hover:text-slate-800 rounded-lg transition-colors">Yearly</button>
            </div>

            {{-- Action Buttons --}}
            <div class="flex gap-3">
                <button
                    class="flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                    Refresh Data
                </button>
                <button
                    class="flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-bold hover:bg-blue-700 shadow-lg shadow-blue-200 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Export Report
                </button>
            </div>
        </div>

        {{-- 2. MAIN STATS ROW --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            {{-- Card 1 --}}
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex flex-col justify-between h-32">
                <p class="text-sm font-semibold text-slate-500">Today's Collection</p>
                <div class="flex items-center gap-3">
                    <h3 class="text-3xl font-bold text-slate-900">₹4,50,670</h3>
                    <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">+2.5%</span>
                </div>
            </div>
            {{-- Card 2 --}}
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex flex-col justify-between h-32">
                <p class="text-sm font-semibold text-slate-500">Today's Expenses</p>
                <div class="flex items-center gap-3">
                    <h3 class="text-3xl font-bold text-slate-900">₹1,20,850</h3>
                    <span class="text-xs font-bold text-rose-600 bg-rose-50 px-2 py-1 rounded-full">-1.2%</span>
                </div>
            </div>
            {{-- Card 3 --}}
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex flex-col justify-between h-32">
                <p class="text-sm font-semibold text-slate-500">Net Balance</p>
                <h3 class="text-3xl font-bold text-slate-900">₹3,29,820</h3>
            </div>
            {{-- Card 4 --}}
            <div
                class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex flex-col justify-between h-32 border-l-4 border-l-slate-800">
                <p class="text-sm font-semibold text-slate-500">Pending Fees</p>
                <h3 class="text-3xl font-bold text-slate-900">₹35,210</h3>
            </div>
        </div>

        {{-- 3. CHARTS SECTION --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- LEFT: Collections vs Expenses --}}
            <div class="xl:col-span-2 bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="font-bold text-slate-900 text-xl">Collections vs Expenses</h3>
                    <div class="flex bg-slate-50 p-1 rounded-lg">
                        <button
                            class="px-4 py-1.5 text-xs font-medium text-slate-500 hover:text-slate-800 transition">Line</button>
                        <button
                            class="px-4 py-1.5 text-xs font-bold bg-white text-slate-900 rounded-md shadow-sm transition">Bar</button>
                    </div>
                </div>

                <div class="relative h-72 w-full flex items-end justify-between px-2 gap-4">
                    {{-- Background Grid --}}
                    <div
                        class="absolute inset-0 flex flex-col justify-between text-xs text-slate-300 pointer-events-none z-0">
                        <div class="border-b border-dashed border-slate-200 w-full h-0"></div>
                        <div class="border-b border-dashed border-slate-200 w-full h-0"></div>
                        <div class="border-b border-dashed border-slate-200 w-full h-0"></div>
                        <div class="border-b border-dashed border-slate-200 w-full h-0"></div>
                        <div class="border-b border-slate-300 w-full h-0"></div>
                    </div>

                    {{-- Bars --}}
                    @foreach (['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'] as $index => $month)
                        @php
                            $h1 = rand(30, 80) . '%';
                            $h2 = rand(15, 50) . '%';
                        @endphp
                        <div class="flex flex-col items-center gap-3 flex-1 h-full justify-end z-10 group cursor-pointer">
                            <div class="flex items-end gap-1.5 h-full w-full justify-center">
                                <div class="w-4 md:w-6 bg-slate-800 rounded-t-md group-hover:bg-slate-700 transition-all shadow-sm"
                                    style="height: {{ $h1 }}"></div>
                                <div class="w-4 md:w-6 bg-blue-500 rounded-t-md group-hover:bg-blue-600 transition-all shadow-sm"
                                    style="height: {{ $h2 }}"></div>
                            </div>
                            <span class="text-xs font-bold text-slate-400">{{ $month }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- RIGHT: Payment Mode Breakdown --}}
            <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm flex flex-col">
                <h3 class="font-bold text-slate-900 text-xl mb-8">Payment Mode Breakdown</h3>

                <div class="flex-1 flex flex-col items-center justify-center">
                    <div class="donut-chart mb-8 shadow-inner">
                        <div class="chart-text">
                            <p class="text-3xl font-bold text-slate-800">100%</p>
                            <p class="text-xs text-slate-400 uppercase tracking-wide font-bold">Total</p>
                        </div>
                    </div>

                    {{-- Legend --}}
                    <div class="grid grid-cols-2 gap-x-8 gap-y-6 w-full px-2">
                        <div class="flex items-start gap-3">
                            <span class="w-3 h-3 rounded-full bg-blue-500 mt-1"></span>
                            <div>
                                <p class="text-sm font-bold text-slate-800">UPI</p>
                                <p class="text-xs text-slate-400">45%</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="w-3 h-3 rounded-full bg-green-500 mt-1"></span>
                            <div>
                                <p class="text-sm font-bold text-slate-800">Cash</p>
                                <p class="text-xs text-slate-400">20%</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="w-3 h-3 rounded-full bg-yellow-500 mt-1"></span>
                            <div>
                                <p class="text-sm font-bold text-slate-800">Card</p>
                                <p class="text-xs text-slate-400">25%</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="w-3 h-3 rounded-full bg-purple-500 mt-1"></span>
                            <div>
                                <p class="text-sm font-bold text-slate-800">Bank</p>
                                <p class="text-xs text-slate-400">10%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 4. CLASS-WISE FEE STATUS (EXACT REPLICA OF image_887a8f.png) --}}
        <div class="flex flex-col gap-6 mt-2">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <h3 class="text-xl font-bold text-slate-900">Class-Wise Fee Status</h3>
                <div class="relative">
                    <select
                        class="appearance-none bg-white border border-slate-200 text-slate-700 text-sm font-bold rounded-xl px-4 py-2.5 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-100 cursor-pointer shadow-sm">
                        <option>Sort by: Class Name</option>
                        <option>Sort by: Highest Pending</option>
                    </select>
                    <svg class="w-4 h-4 text-slate-500 absolute right-3 top-3 pointer-events-none" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                {{-- Card 1: Grade 10 (On Track - Green) --}}
                <div
                    class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h4 class="font-bold text-xl text-slate-900">Grade 10</h4>
                            <p class="text-sm text-slate-500 font-medium mt-1">Section A & B</p>
                        </div>
                        <span
                            class="px-3 py-1 bg-emerald-50 text-emerald-600 text-xs font-bold rounded-lg border border-emerald-100">On
                            Track</span>
                    </div>

                    {{-- Progress --}}
                    <div class="w-full h-3 bg-slate-50 rounded-full mb-6 overflow-hidden">
                        <div class="h-full bg-emerald-500 rounded-full" style="width: 85%"></div>
                    </div>

                    <div class="flex justify-between items-end border-t border-slate-50 pt-4">
                        <div>
                            <p class="text-slate-400 text-xs font-bold uppercase tracking-wide mb-1">Collected</p>
                            <p class="text-lg font-bold text-slate-800">₹8,50,000</p>
                        </div>
                        <div class="text-right">
                            <p class="text-slate-400 text-xs font-bold uppercase tracking-wide mb-1">Pending</p>
                            <p class="text-lg font-bold text-emerald-600">₹1,50,000</p>
                        </div>
                    </div>
                </div>

                {{-- Card 2: Grade 12 (Pending - Orange) --}}
                <div
                    class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h4 class="font-bold text-xl text-slate-900">Grade 12</h4>
                            <p class="text-sm text-slate-500 font-medium mt-1">Science Stream</p>
                        </div>
                        <span
                            class="px-3 py-1 bg-amber-50 text-amber-600 text-xs font-bold rounded-lg border border-amber-100">Pending</span>
                    </div>

                    {{-- Progress --}}
                    <div class="w-full h-3 bg-slate-50 rounded-full mb-6 overflow-hidden">
                        <div class="h-full bg-amber-500 rounded-full" style="width: 60%"></div>
                    </div>

                    <div class="flex justify-between items-end border-t border-slate-50 pt-4">
                        <div>
                            <p class="text-slate-400 text-xs font-bold uppercase tracking-wide mb-1">Collected</p>
                            <p class="text-lg font-bold text-slate-800">₹6,00,000</p>
                        </div>
                        <div class="text-right">
                            <p class="text-slate-400 text-xs font-bold uppercase tracking-wide mb-1">Pending</p>
                            <p class="text-lg font-bold text-amber-600">₹4,00,000</p>
                        </div>
                    </div>
                </div>

                {{-- Card 3: Grade 9 (Critical - Red) --}}
                <div
                    class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h4 class="font-bold text-xl text-slate-900">Grade 9</h4>
                            <p class="text-sm text-slate-500 font-medium mt-1">All Sections</p>
                        </div>
                        <span
                            class="px-3 py-1 bg-rose-50 text-rose-600 text-xs font-bold rounded-lg border border-rose-100">Critical</span>
                    </div>

                    {{-- Progress --}}
                    <div class="w-full h-3 bg-slate-50 rounded-full mb-6 overflow-hidden">
                        <div class="h-full bg-rose-500 rounded-full" style="width: 40%"></div>
                    </div>

                    <div class="flex justify-between items-end border-t border-slate-50 pt-4">
                        <div>
                            <p class="text-slate-400 text-xs font-bold uppercase tracking-wide mb-1">Collected</p>
                            <p class="text-lg font-bold text-slate-800">₹4,00,000</p>
                        </div>
                        <div class="text-right">
                            <p class="text-slate-400 text-xs font-bold uppercase tracking-wide mb-1">Pending</p>
                            <p class="text-lg font-bold text-rose-600">₹6,00,000</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- 5. RECENT TRANSACTIONS TABLE --}}
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden mt-2">
            <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center">
                <h3 class="font-bold text-slate-900 text-lg">Recent Transactions</h3>
                <button class="text-sm font-bold text-blue-600 hover:text-blue-700 hover:underline">View All
                    Transactions</button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead class="bg-slate-50 text-slate-500 text-xs uppercase font-bold tracking-wider">
                        <tr>
                            <th class="px-8 py-4">Student Name</th>
                            <th class="px-8 py-4">Purpose</th>
                            <th class="px-8 py-4">Payment Mode</th>
                            <th class="px-8 py-4 text-right">Amount</th>
                            <th class="px-8 py-4 text-right">Time</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-8 py-5 font-bold text-slate-800">Olivia Chen</td>
                            <td class="px-8 py-5 text-slate-500 font-medium">Tuition Fee</td>
                            <td class="px-8 py-5">
                                <span
                                    class="inline-flex items-center gap-2 text-xs font-bold text-blue-700 bg-blue-50 px-3 py-1.5 rounded-lg">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> UPI
                                </span>
                            </td>
                            <td class="px-8 py-5 text-right font-bold text-slate-900">₹1,200.00</td>
                            <td class="px-8 py-5 text-right text-slate-400 font-medium text-xs">10:45 AM</td>
                        </tr>
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-8 py-5 font-bold text-slate-800">Benjamin Carter</td>
                            <td class="px-8 py-5 text-slate-500 font-medium">Exam Fee</td>
                            <td class="px-8 py-5">
                                <span
                                    class="inline-flex items-center gap-2 text-xs font-bold text-yellow-700 bg-yellow-50 px-3 py-1.5 rounded-lg">
                                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-600"></span> Card
                                </span>
                            </td>
                            <td class="px-8 py-5 text-right font-bold text-slate-900">₹550.00</td>
                            <td class="px-8 py-5 text-right text-slate-400 font-medium text-xs">09:30 AM</td>
                        </tr>
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-8 py-5 font-bold text-slate-800">Aarav Patel</td>
                            <td class="px-8 py-5 text-slate-500 font-medium">Books & Stationery</td>
                            <td class="px-8 py-5">
                                <span
                                    class="inline-flex items-center gap-2 text-xs font-bold text-emerald-700 bg-emerald-50 px-3 py-1.5 rounded-lg">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span> Cash
                                </span>
                            </td>
                            <td class="px-8 py-5 text-right font-bold text-slate-900">₹250.75</td>
                            <td class="px-8 py-5 text-right text-slate-400 font-medium text-xs">09:15 AM</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
