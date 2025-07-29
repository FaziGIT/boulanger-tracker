@props([
    'type' => 'success',
    'message' => ''
])

@php
    $config = [
        'success' => [
            'bg' => 'bg-green-500',
            'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>',
            'progress' => 'bg-green-400',
            'hover' => 'hover:text-green-100',
            'id' => 'flash-success',
            'progressId' => 'progress-success'
        ],
        'error' => [
            'bg' => 'bg-red-500',
            'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>',
            'progress' => 'bg-red-400',
            'hover' => 'hover:text-red-100',
            'id' => 'flash-danger',
            'progressId' => 'progress-danger'
        ],
        'warning' => [
            'bg' => 'bg-yellow-500',
            'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
            </svg>',
            'progress' => 'bg-yellow-400',
            'hover' => 'hover:text-yellow-100',
            'id' => 'flash-warning',
            'progressId' => 'progress-warning'
        ],
        'info' => [
            'bg' => 'bg-blue-500',
            'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>',
            'progress' => 'bg-blue-400',
            'hover' => 'hover:text-blue-100',
            'id' => 'flash-info',
            'progressId' => 'progress-info'
        ]
    ];
    
    $config = $config[$type] ?? $config['success'];
@endphp

<div id="{{ $config['id'] }}"
     class="flash-message {{ $config['bg'] }} text-white px-6 py-4 rounded-lg shadow-lg transform translate-x-full transition-all duration-500 ease-out max-w-sm">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <div class="flex-shrink-0">
                {!! $config['icon'] !!}
            </div>
            <div>
                <p class="text-sm font-medium">{{ $message }}</p>
            </div>
        </div>
        <button onclick="dismissFlash(this.parentElement.parentElement)"
                class="flex-shrink-0 ml-4 text-white {{ $config['hover'] }} transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    <div class="absolute bottom-0 left-0 h-1 {{ $config['progress'] }} rounded-b-lg transition-all duration-300 ease-linear"
         id="{{ $config['progressId'] }}"></div>
</div> 
