@extends('base')

@section('title', 'Sign In')

@section('content')
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="text-center">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-gray-900">Connectez-vous à votre compte</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Bon retour sur Boulanger Tracker
                </p>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
                @php
                    $signInIcon = '<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                    </svg>';
                @endphp

                <form class="space-y-6" method="POST" action="{{ route('login.store') }}">
                    @csrf

                    <x-form-input
                        name="emailOrName"
                        label="Email ou Pseudo"
                        type="text"
                        placeholder="Entrez votre email ou pseudo"
                        autocomplete="email"
                        required="true"
                    />

                    <x-form-input
                        name="password"
                        label="Mot de passe"
                        type="password"
                        placeholder="Entrez votre mot de passe"
                        autocomplete="current-password"
                        required="true"
                        :showPasswordToggle="true"
                    />

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="rememberMe" name="rememberMe" type="checkbox"
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="rememberMe" class="ml-2 block text-sm text-gray-900">
                                Se souvenir de moi
                            </label>
                        </div>
                        @error('rememberMe')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <x-form-button
                        text="Se connecter"
                        :icon="$signInIcon"
                    />
                </form>

                <div class="mt-6 text-center">
                    <a href="{{ route('home.index') }}" class="text-sm text-blue-600 hover:text-blue-500">
                        ← Retour à l'accueil
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
