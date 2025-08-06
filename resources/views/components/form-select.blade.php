@props([
    'name',
    'label',
    'options' => [],
    'selected' => '',
    'required' => false,
    'placeholder' => 'Sélectionner une option'
])

@php
    $inputId = $name;
    $errorClass = $errors->has($name) ? 'border-red-300' : 'border-gray-300';
    $baseClasses = 'appearance-none relative block w-full px-3 py-2 border placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm bg-white';
@endphp

<div>
    <label for="{{ $inputId }}" class="block text-sm font-medium text-gray-700 mb-2">
        {{ $label }}
        @if($required)
            <span class="text-red-500">*</span>
        @endif
    </label>

    <div class="relative">
        <select
            id="{{ $inputId }}"
            name="{{ $name }}"
            class="{{ $baseClasses }} {{ $errorClass }}"
            {{ $required ? 'required' : '' }}
        >
            <option value="" {{ (old($name) == '' || $selected == '') ? 'selected' : '' }}>{{ $placeholder }}</option>
            @foreach($options as $value => $label)
                <option value="{{ $value }}" {{ (old($name) == $value || $selected == $value) ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        
        <!-- Custom dropdown arrow -->
        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>
    </div>

    @error($name)
    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div> 
