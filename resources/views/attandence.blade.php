@extends('layouts.app')

@section('title', 'Attendance')

@section('content')

    {{-- DATA SIMULATION (Since we are doing Frontend only) --}}
    @php
        // 1. Mock Stats
        $stats = [
            'total_students' => 1250,
            'present_today' => 1180,
            'absent_today' => 45,
            'late_today' => 25,
        ];

        // 2. Mock Chart Data
        $chartData = [
            'dates' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            'present' => [1150, 1180, 1160, 1190, 1180, 900],
            'absent' => [50, 45, 60, 40, 45, 10],
            'late' => [30, 25, 30, 20, 25, 5],
        ];

        // 3. Mock Student List
        $students = [
            ['name' => 'Aarav Sharma', 'roll' => '101', 'status' => 'Present', 'time' => '08:00 AM'],
            ['name' => 'Vihaan Gupta', 'roll' => '102', 'status' => 'Absent', 'time' => '-'],
            ['name' => 'Aditya Verma', 'roll' => '103', 'status' => 'Late', 'time' => '08:45 AM'],
            ['name' => 'Sai Kumar', 'roll' => '104', 'status' => 'Present', 'time' => '07:55 AM'],
            ['name' => 'Reyansh Singh', 'roll' => '105', 'status' => 'Present', 'time' => '08:05 AM'],
            ['name' => 'Ishaan Patel', 'roll' => '106', 'status' => 'Present', 'time' => '08:02 AM'],
        ];
    @endphp

    <div class="min-h-screen bg-slate-50 p-6">

        {{-- Header Section --}}
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Attendance Overview</h1>
                <p class="text-sm text-slate-500 mt-1">Manage daily records and view attendance analytics.</p>
            </div>
            <div class="flex gap-3">
                <button
                    class="flex items-center gap-2 rounded-lg bg-white border border-gray-200 px-4 py-2 text-sm font-bold text-slate-600 shadow-sm hover:bg-gray-50 hover:text-slate-800 transition-colors">
                    <span class="material-symbols-outlined text-lg">download</span>
                    Export Report
                </button>
                <button
                    class="flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-bold text-white shadow-md shadow-indigo-200 hover:bg-indigo-700 hover:shadow-lg transition-all">
                    <span class="material-symbols-outlined text-lg">check_circle</span>
                    Take Attendance
                </button>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="mb-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            {{-- Card 1: Total --}}
            <div
                class="group relative overflow-hidden rounded-xl bg-white p-6 shadow-md shadow-blue-100 border border-blue-50 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-200/50">
                <div class="flex items-center gap-4">
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-lg bg-blue-50 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <span class="material-symbols-outlined">groups</span>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Students</p>
                        <p class="text-2xl font-bold text-slate-700 mt-1">{{ $stats['total_students'] }}</p>
                    </div>
                </div>
            </div>

            {{-- Card 2: Present --}}
            <div
                class="group relative overflow-hidden rounded-xl bg-white p-6 shadow-md shadow-emerald-100 border border-emerald-50 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-emerald-200/50">
                <div class="flex items-center gap-4">
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                        <span class="material-symbols-outlined">person_check</span>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Present Today</p>
                        <p class="text-2xl font-bold text-slate-700 mt-1">{{ $stats['present_today'] }}</p>
                    </div>
                </div>
            </div>

            {{-- Card 3: Absent --}}
            <div
                class="group relative overflow-hidden rounded-xl bg-white p-6 shadow-md shadow-rose-100 border border-rose-50 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-rose-200/50">
                <div class="flex items-center gap-4">
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-lg bg-rose-50 text-rose-600 group-hover:bg-rose-600 group-hover:text-white transition-colors">
                        <span class="material-symbols-outlined">person_off</span>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Absent Today</p>
                        <p class="text-2xl font-bold text-slate-700 mt-1">{{ $stats['absent_today'] }}</p>
                    </div>
                </div>
            </div>

            {{-- Card 4: Late --}}
            <div
                class="group relative overflow-hidden rounded-xl bg-white p-6 shadow-md shadow-amber-100 border border-amber-50 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-amber-200/50">
                <div class="flex items-center gap-4">
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-lg bg-amber-50 text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-colors">
                        <span class="material-symbols-outlined">schedule</span>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Late Arrivals</p>
                        <p class="text-2xl font-bold text-slate-700 mt-1">{{ $stats['late_today'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

            {{-- Chart Section (Spans 2 columns) --}}
            <div class="rounded-xl bg-white p-6 shadow-md shadow-blue-100 border border-blue-50 lg:col-span-2">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-bold text-slate-700">Weekly Attendance Analytics</h3>
                    <select
                        class="text-xs border-none bg-slate-50 rounded-md text-slate-500 font-bold focus:ring-0 cursor-pointer hover:bg-slate-100">
                        <option>This Week</option>
                        <option>Last Week</option>
                    </select>
                </div>
                <div class="relative h-80 w-full">
                    <canvas id="attendanceChart"></canvas>
                </div>
            </div>

            {{-- Quick Student List (Spans 1 column) --}}
            <div class="flex flex-col rounded-xl bg-white shadow-md shadow-blue-100 border border-blue-50 h-full">
                <div class="p-6 border-b border-gray-50">
                    <h3 class="font-bold text-slate-700">Recent Activity</h3>
                    <p class="text-xs text-slate-400 mt-1">Live updates from classrooms</p>
                </div>

                <div class="flex-1 overflow-y-auto px-6 py-2 max-h-[400px]">
                    <ul role="list" class="divide-y divide-gray-50">
                        @foreach ($students as $student)
                            <li class="py-4 group cursor-pointer transition-colors hover:bg-slate-50 -mx-4 px-4 rounded-md">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <span
                                            class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-500 ring-2 ring-white shadow-sm group-hover:bg-white group-hover:ring-indigo-100 transition-all">
                                            <span class="text-sm font-bold">{{ substr($student['name'], 0, 1) }}</span>
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p
                                            class="truncate text-sm font-bold text-slate-700 group-hover:text-indigo-600 transition-colors">
                                            {{ $student['name'] }}</p>
                                        <p class="truncate text-xs font-medium text-slate-400">Roll: {{ $student['roll'] }}
                                            • <span class="text-slate-300">{{ $student['time'] }}</span></p>
                                    </div>
                                    <div>
                                        @if ($student['status'] === 'Present')
                                            <span
                                                class="inline-flex items-center rounded-md bg-green-50 px-2.5 py-1 text-xs font-bold text-green-600 ring-1 ring-inset ring-green-600/10">Present</span>
                                        @elseif($student['status'] === 'Absent')
                                            <span
                                                class="inline-flex items-center rounded-md bg-red-50 px-2.5 py-1 text-xs font-bold text-red-600 ring-1 ring-inset ring-red-600/10">Absent</span>
                                        @else
                                            <span
                                                class="inline-flex items-center rounded-md bg-amber-50 px-2.5 py-1 text-xs font-bold text-amber-600 ring-1 ring-inset ring-amber-600/10">Late</span>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="p-4 border-t border-gray-50 bg-gray-50/50 rounded-b-xl">
                    <a href="#"
                        class="flex w-full items-center justify-center rounded-lg bg-white px-3 py-2.5 text-xs font-bold text-slate-600 shadow-sm border border-gray-200 hover:bg-slate-50 hover:text-indigo-600 transition-all">
                        View Full Attendance Log
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart.js Script --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('attendanceChart');

        // Get data passed from the @php block above
        const labels = @json($chartData['dates']);
        const presentData = @json($chartData['present']);
        const absentData = @json($chartData['absent']);
        const lateData = @json($chartData['late']);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Present',
                        data: presentData,
                        backgroundColor: '#10b981',
                        borderRadius: 6,
                        barThickness: 25,
                    },
                    {
                        label: 'Absent',
                        data: absentData,
                        backgroundColor: '#f43f5e',
                        borderRadius: 6,
                        barThickness: 25,
                    },
                    {
                        label: 'Late',
                        data: lateData,
                        backgroundColor: '#f59e0b',
                        borderRadius: 6,
                        barThickness: 25,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                family: "'Inter', sans-serif",
                                size: 11
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        padding: 12,
                        cornerRadius: 8,
                        titleFont: {
                            size: 13
                        },
                        bodyFont: {
                            size: 12
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f1f5f9',
                            borderDash: [5, 5]
                        },
                        ticks: {
                            font: {
                                size: 11
                            },
                            color: '#64748b'
                        },
                        border: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11,
                                weight: 'bold'
                            },
                            color: '#64748b'
                        },
                        border: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
@endsection
