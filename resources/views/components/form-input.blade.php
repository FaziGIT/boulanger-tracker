@props([
    'name',
    'label',
    'type' => 'text',
    'placeholder' => '',
    'value' => '',
    'required' => false,
    'autocomplete' => '',
    'accept' => '',
    'onchange' => '',
    'oninput' => '',
    'showPasswordToggle' => false
])

@php
    $inputId = $name;
    $errorClass = $errors->has($name) ? 'border-red-300' : 'border-gray-300';
    $baseClasses = 'appearance-none relative block w-full px-3 py-2 border placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm';
@endphp

<div>
    <label for="{{ $inputId }}" class="block text-sm font-medium text-gray-700 mb-2">
        {{ $label }}
        @if($required)
            <span class="text-red-500">*</span>
        @endif
    </label>

    @if($type === 'file')
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center overflow-hidden"
                 id="image-preview-{{ $inputId }}">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <div class="flex-1">
                <input
                    id="{{ $inputId }}"
                    name="{{ $name }}"
                    type="{{ $type }}"
                    accept="{{ $accept }}"
                    {{ $onchange ? "onchange=\"{$onchange}\"" : '' }}
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 {{ $errorClass }}"
                    {{ $required ? 'required' : '' }}
                >
                <p class="mt-1 text-xs text-gray-500">
                    JPEG, PNG, JPG, GIF, SVG up to 2MB
                </p>
            </div>
        </div>
    @else
        <div class="relative">
            <input
                id="{{ $inputId }}"
                name="{{ $name }}"
                type="{{ $type }}"
                autocomplete="{{ $autocomplete }}"
                placeholder="{{ $placeholder }}"
                value="{{ $value ?: old($name) }}"
                {{ $oninput ? "oninput=\"{$oninput}\"" : '' }}
                class="{{ $baseClasses }} {{ $errorClass }} {{ $showPasswordToggle ? 'pr-10' : '' }}"
                {{ $required ? 'required' : '' }}
            >
            @if($showPasswordToggle)
                <button
                    type="button"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center"
                    onclick="togglePasswordVisibility('{{ $inputId }}')"
                >
                    <svg id="eye-icon-{{ $inputId }}"
                         class="h-5 w-5 text-gray-400 hover:text-gray-600 transition-colors" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                    </svg>
                </button>
            @endif
        </div>
    @endif

    @error($name)
    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
