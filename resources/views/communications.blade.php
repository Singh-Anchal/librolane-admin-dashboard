@extends('layouts.app')

@section('title', 'Inbox')

@section('content')

    {{-- 
      DATA SIMULATION 
    --}}
    @php
        $user = [
            'name' => 'Dr. Evelyn Reed',
            'role' => 'Principal',
            'avatar' => 'https://ui-avatars.com/api/?name=Evelyn+Reed&background=0D8ABC&color=fff',
        ];

        $currentMessage = [
            'id' => 1,
            'subject' => 'PTA Meeting Follow-Up',
            'sender_name' => 'Anika Sharma',
            'sender_role' => 'PTA President',
            'sender_avatar' => 'https://i.pravatar.cc/150?u=anika',
            'time' => '10:45 AM',
            'date' => 'Today',
            'to' => 'Dr. Evelyn Reed',
            'body' => '
                <p class="mb-4">Hi Dr. Reed,</p>
                <p class="mb-4">Thank you for your time at the PTA meeting yesterday. It was very productive.</p>
                <p class="mb-4">Regarding the budget for the upcoming science fair, we need to finalize the numbers by Friday. Could you please review the attached document? I\'ve outlined the proposed expenditures and included quotes from vendors for the key materials.</p>
                <p class="mb-4">Please let me know if you have any questions or require any adjustments.</p>
                <p>Best regards,<br>Anika Sharma<br>PTA President</p>
            ',
            'attachments' => [
                [
                    'name' => 'Science_Fair_Budget_v2.docx',
                    'size' => '128 KB',
                    'type' => 'docx',
                ],
            ],
        ];

        $conversations = [
            [
                'id' => 1,
                'name' => 'Anika Sharma',
                'avatar' => 'https://i.pravatar.cc/150?u=anika',
                'status' => 'online',
                'time' => '10:45 AM',
                'subject' => 'PTA Meeting Follow-Up',
                'preview' => 'Regarding the budget for the upcoming science fair...',
                'unread' => false,
                'active' => true,
            ],
            [
                'id' => 2,
                'name' => 'Mr. & Mrs. Doe',
                'avatar' => 'https://i.pravatar.cc/150?u=doe',
                'status' => 'busy',
                'time' => 'Yesterday',
                'subject' => 'Absence Request: John Doe',
                'preview' => 'Hi, my son John Doe in Grade 5 will be absent...',
                'unread' => true,
                'active' => false,
            ],
            [
                'id' => 3,
                'name' => 'Michael Chen',
                'avatar' => 'https://i.pravatar.cc/150?u=michael',
                'status' => 'offline',
                'time' => 'Mon',
                'subject' => 'Field Trip Permission Slips',
                'preview' => 'Just a reminder that all permission slips for the museum...',
                'unread' => false,
                'active' => false,
            ],
            [
                'id' => 4,
                'name' => 'IT Department',
                'avatar' => 'https://ui-avatars.com/api/?name=IT+Dept&background=E5E7EB&color=374151',
                'status' => 'offline',
                'time' => 'Oct 28',
                'subject' => '[ANNOUNCEMENT] Scheduled System...',
                'preview' => 'Please be advised that we will be performing scheduled...',
                'unread' => false,
                'active' => false,
            ],
        ];

        $navItems = [
            ['icon' => 'inbox', 'label' => 'Inbox', 'active' => true],
            ['icon' => 'send', 'label' => 'Sent', 'active' => false],
            ['icon' => 'campaign', 'label' => 'Announcements', 'active' => false],
            ['icon' => 'draft', 'label' => 'Drafts', 'active' => false],
            ['icon' => 'group', 'label' => 'Contacts', 'active' => false],
        ];
    @endphp

    {{-- MAIN LAYOUT CONTAINER --}}
    <div class="flex h-[85vh] w-full overflow-hidden bg-white rounded-xl shadow-sm border border-gray-200 font-sans">

        {{-- ========================================== --}}
        {{-- COLUMN 1: LEFT NAVIGATION SIDEBAR         --}}
        {{-- ========================================== --}}
        <div class="hidden md:flex w-64 flex-col justify-between border-r border-gray-200 bg-white p-4 shrink-0">

            <div class="flex flex-col gap-6">
                {{-- User Profile --}}
                <div class="flex items-center gap-3 px-2">
                    <img src="{{ $user['avatar'] }}" alt="Profile"
                        class="h-10 w-10 rounded-full object-cover border border-gray-200">
                    <div class="flex flex-col overflow-hidden">
                        <span class="text-sm font-bold text-gray-900 truncate">{{ $user['name'] }}</span>
                        <span class="text-xs text-gray-500 truncate">{{ $user['role'] }}</span>
                    </div>
                </div>

                {{-- Navigation Links --}}
                <nav class="space-y-1">
                    @foreach ($navItems as $item)
                        <a href="#"
                            class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition-colors 
                            {{ $item['active'] ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <span
                                class="material-symbols-outlined text-[20px] {{ $item['active'] ? 'text-blue-600' : 'text-gray-400' }}">
                                {{ $item['icon'] }}
                            </span>
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>
            </div>

            {{-- New Message Button --}}
            <button
                class="flex w-full items-center justify-center gap-2 rounded-lg bg-blue-600 py-2.5 text-sm font-bold text-white shadow-sm hover:bg-blue-700 transition-colors">
                <span class="material-symbols-outlined text-[20px]">edit</span>
                New Message
            </button>
        </div>

        {{-- ========================================== --}}
        {{-- COLUMN 2: MESSAGE LIST (INBOX)            --}}
        {{-- ========================================== --}}
        <div class="flex w-full md:w-80 lg:w-96 flex-col border-r border-gray-200 bg-white shrink-0">

            {{-- Search Bar --}}
            <div class="p-4 border-b border-gray-100">
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <span class="material-symbols-outlined text-[20px] text-gray-400">search</span>
                    </div>
                    <input type="text"
                        class="block w-full rounded-lg border-none bg-gray-100 py-2.5 pl-10 text-gray-900 placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-blue-500 sm:text-sm"
                        placeholder="Search messages...">
                </div>
            </div>

            {{-- Message List Items --}}
            <div class="flex-1 overflow-y-auto">
                <ul class="divide-y divide-gray-50">
                    @foreach ($conversations as $conv)
                        <li
                            class="relative cursor-pointer transition-colors hover:bg-gray-50 {{ $conv['active'] ? 'bg-blue-50/40' : '' }}">

                            {{-- Active Indicator Line --}}
                            @if ($conv['active'])
                                <div class="absolute left-0 top-0 bottom-0 w-1 bg-blue-600 rounded-r-md"></div>
                            @endif

                            <div class="flex gap-3 px-4 py-4">
                                {{-- Avatar --}}
                                <div class="relative flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ $conv['avatar'] }}"
                                        alt="">
                                    {{-- Status Dot --}}
                                    @if ($conv['status'] === 'online')
                                        <span
                                            class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-green-500 ring-2 ring-white"></span>
                                    @elseif($conv['status'] === 'busy')
                                        <span
                                            class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-red-500 ring-2 ring-white"></span>
                                    @endif
                                </div>

                                {{-- Details --}}
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center justify-between mb-0.5">
                                        <p
                                            class="truncate text-sm font-semibold {{ $conv['unread'] ? 'text-gray-900' : 'text-gray-900' }}">
                                            {{ $conv['name'] }}
                                        </p>
                                        <p
                                            class="text-xs text-gray-400 whitespace-nowrap ml-2 {{ $conv['active'] ? 'text-blue-600 font-medium' : '' }}">
                                            {{ $conv['time'] }}</p>
                                    </div>
                                    <p
                                        class="truncate text-xs font-medium {{ $conv['unread'] ? 'text-gray-900' : 'text-gray-600' }} mb-0.5">
                                        {{ $conv['subject'] }}
                                    </p>
                                    <p class="truncate text-xs text-gray-400">
                                        {{ $conv['preview'] }}
                                    </p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- COLUMN 3: MESSAGE CONTENT (VIEWER)        --}}
        {{-- ========================================== --}}
        <div class="hidden lg:flex flex-1 flex-col bg-slate-50 min-w-0">

            {{-- Header --}}
            <div class="flex items-start justify-between border-b border-gray-200 bg-white px-6 py-5">
                <div class="flex-1 min-w-0 mr-4">
                    <h2 class="text-xl font-bold text-gray-900 truncate">{{ $currentMessage['subject'] }}</h2>
                    <div class="mt-1 flex items-center gap-2 text-xs">
                        <span class="text-gray-500">From:</span>
                        <span class="font-semibold text-gray-900">{{ $currentMessage['sender_name'] }},
                            {{ $currentMessage['sender_role'] }}</span>
                        <span class="text-gray-300">•</span>
                        <span class="text-gray-500">To:</span>
                        <span class="text-gray-700">{{ $currentMessage['to'] }}</span>
                    </div>
                </div>

                {{-- Header Actions --}}
                <div class="flex items-center gap-2 shrink-0">
                    <p class="text-xs text-gray-400 mr-2">{{ $currentMessage['date'] }}, {{ $currentMessage['time'] }}</p>

                    <button class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                        <span class="material-symbols-outlined text-[20px]">reply</span>
                    </button>

                    {{-- 
                        WORKING THREE DOTS MENU (using Alpine.js)
                    --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.outside="open = false"
                            class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors focus:outline-none">
                            <span class="material-symbols-outlined text-[20px]">more_horiz</span>
                        </button>

                        {{-- Dropdown Body --}}
                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 z-50 mt-2 w-48 origin-top-right rounded-lg bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none border border-gray-100"
                            style="display: none;">

                            <a href="#"
                                class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px] text-gray-400">forward</span>
                                Forward
                            </a>
                            <a href="#"
                                class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px] text-gray-400">print</span>
                                Print
                            </a>
                            <a href="#"
                                class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px] text-gray-400">mark_email_unread</span>
                                Mark as Unread
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <a href="#"
                                class="block px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                Delete
                            </a>
                        </div>
                    </div>
                    {{-- End Dropdown --}}

                </div>
            </div>

            {{-- Message Body (Scrollable) --}}
            <div class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6">
                <div class="prose prose-sm max-w-none text-gray-800 leading-relaxed">
                    {!! $currentMessage['body'] !!}
                </div>

                {{-- Attachments --}}
                @if (count($currentMessage['attachments']) > 0)
                    <div class="pt-4">
                        <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Attachments
                            ({{ count($currentMessage['attachments']) }})</h4>
                        <div class="flex flex-wrap gap-4">
                            @foreach ($currentMessage['attachments'] as $file)
                                <div
                                    class="flex items-center gap-3 rounded-xl border border-gray-200 bg-white p-3 pr-4 shadow-sm hover:shadow-md transition-shadow cursor-pointer w-auto select-none">
                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                                        <span class="material-symbols-outlined">description</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm font-semibold text-gray-900">{{ $file['name'] }}</span>
                                        <span class="text-xs text-gray-500">{{ $file['size'] }}</span>
                                    </div>
                                    <span class="material-symbols-outlined text-gray-400 ml-4">download</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- Reply Area --}}
            <div class="bg-white p-6 border-t border-gray-200">
                <div
                    class="rounded-xl border border-gray-200 shadow-sm bg-white overflow-hidden focus-within:ring-2 focus-within:ring-blue-500/20 focus-within:border-blue-500 transition-all">
                    <textarea class="w-full border-none p-4 text-gray-900 placeholder:text-gray-400 focus:ring-0 resize-none text-sm"
                        rows="3" placeholder="Reply to Anika Sharma..."></textarea>

                    <div class="flex items-center justify-between px-2 py-2 bg-white border-t border-gray-100">
                        <div class="flex items-center gap-1">
                            <button type="button"
                                class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-50 rounded-lg">
                                <span class="material-symbols-outlined text-[20px]">attach_file</span>
                            </button>
                            <button type="button"
                                class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-50 rounded-lg">
                                <span class="material-symbols-outlined text-[20px]">link</span>
                            </button>
                            <button type="button"
                                class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-50 rounded-lg">
                                <span class="material-symbols-outlined text-[20px]">sentiment_satisfied</span>
                            </button>
                            <div class="h-4 w-px bg-gray-200 mx-1"></div>
                            <button type="button"
                                class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-50 rounded-lg">
                                <span class="material-symbols-outlined text-[20px]">image</span>
                            </button>
                        </div>

                        <button
                            class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-1.5 rounded-lg text-sm font-bold shadow-sm transition-all">
                            Send
                            <span class="material-symbols-outlined text-[16px]">send</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection

@push('styles')
    {{-- Google Material Icons --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <style>
        /* Modern Scrollbar */
        .overflow-y-auto::-webkit-scrollbar {
            width: 5px;
        }

        .overflow-y-auto::-webkit-scrollbar-track {
            background: transparent;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 20px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background-color: #94a3b8;
        }
    </style>
@endpush

@push('scripts')
    {{-- Alpine.js for the Dropdown --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
@endpush
