@extends('layouts.app')

@section('title', 'Students List')

@section('content')
    {{-- 1. LOAD ALPINE JS DIRECTLY HERE (Ensures it works) --}}
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

        {{-- HEADER SECTION --}}
        <div class="flex flex-wrap justify-between gap-4 items-center">
            <div class="flex flex-col">
                <h1 class="text-3xl font-bold text-slate-900">Students</h1>
                <p class="text-slate-500 text-sm">Manage all enrolled students</p>
            </div>

            <button
                class="flex items-center justify-center h-10 px-4 rounded-lg bg-[#2b8cee] text-white text-sm font-medium gap-2 hover:bg-blue-600 transition-colors shadow-sm">
                <span class="material-symbols-outlined text-[20px]">add</span>
                <span>Add Student</span>
            </button>
        </div>

        {{-- MAIN CARD --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm">

            {{-- FILTER BAR (ALL FILTERS INCLUDED) --}}
            <div class="p-4 border-b border-slate-100 flex flex-col xl:flex-row gap-4 items-center justify-between">

                {{-- Search Input --}}
                <div class="relative w-full xl:max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="material-symbols-outlined text-slate-400 text-[20px]">search</span>
                    </div>
                    <input type="text"
                        class="block w-full pl-10 pr-3 py-2.5 border border-slate-200 rounded-lg bg-slate-50 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-[#2b8cee] focus:border-[#2b8cee] sm:text-sm"
                        placeholder="Search by name, email, or roll number...">
                </div>

                {{-- Filters & Export --}}
                <div class="flex flex-wrap gap-3 w-full xl:w-auto items-center justify-end">

                    {{-- Filter Icon --}}
                    <span class="material-symbols-outlined text-slate-400">filter_list</span>

                    {{-- Class Filter --}}
                    <div class="relative">
                        <select
                            class="appearance-none pl-3 pr-8 py-2.5 border border-slate-200 rounded-lg text-sm font-medium text-slate-700 bg-white hover:bg-slate-50 focus:outline-none cursor-pointer">
                            <option>All Classes</option>
                            <option>Grade 9</option>
                            <option>Grade 10</option>
                            <option>Grade 11</option>
                            <option>Grade 12</option>
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
                            <option>Inactive</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-500">
                            <span class="material-symbols-outlined text-[20px]">expand_more</span>
                        </div>
                    </div>

                    {{-- Fees Filter --}}
                    <div class="relative">
                        <select
                            class="appearance-none pl-3 pr-8 py-2.5 border border-slate-200 rounded-lg text-sm font-medium text-slate-700 bg-white hover:bg-slate-50 focus:outline-none cursor-pointer">
                            <option>Fees: All</option>
                            <option>Paid</option>
                            <option>Pending</option>
                            <option>Overdue</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-500">
                            <span class="material-symbols-outlined text-[20px]">expand_more</span>
                        </div>
                    </div>

                    {{-- Export Button --}}
                    <button
                        class="flex items-center justify-center px-4 py-2.5 border border-slate-200 rounded-lg text-sm font-medium text-slate-700 bg-white hover:bg-slate-50 gap-2 transition-colors">
                        <span class="material-symbols-outlined text-[20px]">download</span>
                        <span>Export</span>
                    </button>
                </div>
            </div>

            {{-- DATA TABLE --}}
            {{-- NOTE: Added 'pb-32' (padding bottom) so the last dropdown has space to open --}}
            <div class="overflow-x-auto pb-32" style="min-height: 400px;">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50/50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Student</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Roll No</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Class</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Contact</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Status</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Fees</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500 text-right">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">

                        @php
                            $students = [
                                [
                                    'initials' => 'AH',
                                    'color' => 'bg-blue-100 text-blue-600',
                                    'name' => 'Ahmed Hassan',
                                    'email' => 'ahmed.h@school.edu',
                                    'id' => '2024001',
                                    'grade' => 'Grade 10-A',
                                    'phone' => '555-0101',
                                    'status' => 'Active',
                                    'payment' => 'Paid',
                                ],
                                [
                                    'initials' => 'SM',
                                    'color' => 'bg-purple-100 text-purple-600',
                                    'name' => 'Sara Mohammed',
                                    'email' => 'sara.m@school.edu',
                                    'id' => '2024002',
                                    'grade' => 'Grade 10-A',
                                    'phone' => '555-0102',
                                    'status' => 'Active',
                                    'payment' => 'Paid',
                                ],
                                [
                                    'initials' => 'OA',
                                    'color' => 'bg-blue-100 text-blue-600',
                                    'name' => 'Omar Ali',
                                    'email' => 'omar.a@school.edu',
                                    'id' => '2024003',
                                    'grade' => 'Grade 10-B',
                                    'phone' => '555-0103',
                                    'status' => 'Active',
                                    'payment' => 'Pending',
                                ],
                                [
                                    'initials' => 'FK',
                                    'color' => 'bg-emerald-100 text-emerald-600',
                                    'name' => 'Fatima Khan',
                                    'email' => 'fatima.k@school.edu',
                                    'id' => '2024004',
                                    'grade' => 'Grade 9-A',
                                    'phone' => '555-0104',
                                    'status' => 'Active',
                                    'payment' => 'Paid',
                                ],
                            ];
                        @endphp

                        @foreach ($students as $index => $student)
                            <tr class="group hover:bg-slate-50 transition-colors">

                                {{-- Name & Avatar --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="h-10 w-10 rounded-full {{ $student['color'] }} flex items-center justify-center text-xs font-bold ring-2 ring-white">
                                            {{ $student['initials'] }}
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="font-semibold text-slate-900">{{ $student['name'] }}</span>
                                            <span class="text-xs text-slate-500">{{ $student['email'] }}</span>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-slate-500">{{ $student['id'] }}</td>
                                <td class="px-6 py-4 text-slate-800 font-medium">{{ $student['grade'] }}</td>
                                <td class="px-6 py-4 text-slate-500">{{ $student['phone'] }}</td>

                                {{-- Status Badge --}}
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $student['status'] === 'Active' ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">
                                        {{ $student['status'] }}
                                    </span>
                                </td>

                                {{-- Fees Badge --}}
                                <td class="px-6 py-4">
                                    @if ($student['payment'] === 'Paid')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-600">Paid</span>
                                    @elseif($student['payment'] === 'Pending')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-600">Pending</span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-600">Overdue</span>
                                    @endif
                                </td>

                                {{-- ACTION DROPDOWN --}}
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <div x-data="{ open: false }" class="relative inline-block text-left">

                                        <button @click="open = !open" @click.outside="open = false"
                                            class="p-2 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors focus:outline-none">
                                            <span class="material-symbols-outlined">more_horiz</span>
                                        </button>

                                        {{-- Dropdown Menu --}}
                                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                            x-transition:enter-start="opacity-0 scale-95"
                                            x-transition:enter-end="opacity-100 scale-100" style="display: none;"
                                            class="absolute right-0 z-50 mt-2 w-48 origin-top-right rounded-lg bg-white shadow-xl ring-1 ring-black ring-opacity-5 focus:outline-none border border-slate-100">

                                            <div class="py-1">
                                                <a href="#"
                                                    class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 transition-colors text-left">
                                                    View Profile
                                                </a>
                                                <a href="#"
                                                    class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 transition-colors text-left">
                                                    Edit Details
                                                </a>
                                                <a href="#"
                                                    class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 transition-colors text-left">
                                                    View Attendance
                                                </a>
                                                <a href="#"
                                                    class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 transition-colors text-left">
                                                    View Grades
                                                </a>
                                                <div class="h-px bg-slate-100 my-1"></div>
                                                <a href="#"
                                                    class="block px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors text-left">
                                                    Remove Student
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Footer / Pagination --}}
            <div class="border-t border-slate-200 p-4 flex items-center justify-between">
                <p class="text-sm text-slate-500">Showing <span class="font-bold text-slate-900">1-4</span> of <span
                        class="font-bold text-slate-900">120</span> students</p>
                <div class="flex gap-2">
                    <button
                        class="px-3 py-1 text-sm border border-slate-200 rounded-md text-slate-500 hover:bg-slate-50 transition-colors">Previous</button>
                    <button
                        class="px-3 py-1 text-sm border border-slate-200 rounded-md text-slate-500 hover:bg-slate-50 transition-colors">Next</button>
                </div>
            </div>
        </div>
    </div>
@endsection
