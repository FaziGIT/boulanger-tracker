@props([
    'type' => 'submit',
    'text',
    'icon' => '',
    'color' => 'blue',
    'fullWidth' => true
])

@php
    $colorClasses = [
        'blue' => 'bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 text-blue-500 group-hover:text-blue-400',
        'green' => 'bg-green-600 hover:bg-green-700 focus:ring-green-500 text-green-500 group-hover:text-green-400',
        'red' => 'bg-red-600 hover:bg-red-700 focus:ring-red-500 text-red-500 group-hover:text-red-400',
        'gray' => 'bg-gray-600 hover:bg-gray-700 focus:ring-gray-500 text-gray-500 group-hover:text-gray-400'
    ];
    
    $bgColor = $colorClasses[$color] ?? $colorClasses['blue'];
    $widthClass = $fullWidth ? 'w-full' : '';
@endphp

<button type="{{ $type }}"
        class="group relative {{ $widthClass }} flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-lg text-white {{ $bgColor }} focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors duration-200 cursor-pointer">
    @if($icon)
        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
            {!! $icon !!}
        </span>
    @endif
    {{ $text }}
</button> 
