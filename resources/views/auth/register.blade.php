@extends('base')

@section('title', 'Sign Up')

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
                <h2 class="text-3xl font-bold text-gray-900">Créez votre compte</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Rejoignez Boulanger Tracker pour commencer à suivre vos achats
                </p>
            </div>

            @php
                $createAccountIcon = '<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>';
            @endphp

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
                <form class="space-y-6" method="POST" action="{{ route('register.index') }}"
                      enctype="multipart/form-data">
                    @csrf

                    <x-form-input
                        name="name"
                        label="Pseudo"
                        type="text"
                        placeholder="Entrez votre pseudo"
                        autocomplete="name"
                        required="true"
                    />

                    <x-form-input
                        name="email"
                        label="Adresse email"
                        type="email"
                        placeholder="Entrez votre email"
                        autocomplete="email"
                        required="true"
                    />

                    <x-form-input
                        name="password"
                        label="Mot de passe"
                        type="password"
                        placeholder="Créez un mot de passe"
                        autocomplete="new-password"
                        required="true"
                    />

                    <!-- Password Strength Requirements -->
                    <div class="mt-3 space-y-2">
                        <div class="flex items-center space-x-2">
                            <div id="uppercase-check"
                                 class="w-4 h-4 rounded-full border-2 border-gray-300 flex items-center justify-center transition-all duration-300">
                                <svg class="w-3 h-3 text-white opacity-0 transition-opacity duration-300"
                                     fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-sm text-gray-600 transition-colors duration-300" id="uppercase-text">Au moins une lettre majuscule</span>
                        </div>

                        <div class="flex items-center space-x-2">
                            <div id="lowercase-check"
                                 class="w-4 h-4 rounded-full border-2 border-gray-300 flex items-center justify-center transition-all duration-300">
                                <svg class="w-3 h-3 text-white opacity-0 transition-opacity duration-300"
                                     fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-sm text-gray-600 transition-colors duration-300" id="lowercase-text">Au moins une lettre minuscule</span>
                        </div>

                        <div class="flex items-center space-x-2">
                            <div id="number-check"
                                 class="w-4 h-4 rounded-full border-2 border-gray-300 flex items-center justify-center transition-all duration-300">
                                <svg class="w-3 h-3 text-white opacity-0 transition-opacity duration-300"
                                     fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-sm text-gray-600 transition-colors duration-300" id="number-text">Au moins un chiffre</span>
                        </div>

                        <div class="flex items-center space-x-2">
                            <div id="special-check"
                                 class="w-4 h-4 rounded-full border-2 border-gray-300 flex items-center justify-center transition-all duration-300">
                                <svg class="w-3 h-3 text-white opacity-0 transition-opacity duration-300"
                                     fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-sm text-gray-600 transition-colors duration-300" id="special-text">Au moins un caractère spécial</span>
                        </div>

                        <div class="flex items-center space-x-2">
                            <div id="length-check"
                                 class="w-4 h-4 rounded-full border-2 border-gray-300 flex items-center justify-center transition-all duration-300">
                                <svg class="w-3 h-3 text-white opacity-0 transition-opacity duration-300"
                                     fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-sm text-gray-600 transition-colors duration-300" id="length-text">Au moins 8 caractères</span>
                        </div>
                    </div>

                    <!-- Password Strength Bar -->
                    <div class="mt-3">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-xs text-gray-500">Force du mot de passe</span>
                            <span class="text-xs font-medium" id="strength-text">Faible</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div id="strength-bar" class="h-2 rounded-full transition-all duration-500 ease-out"
                                 style="width: 0"></div>
                        </div>
                    </div>

                    <x-form-input
                        name="password_confirmation"
                        label="Confirmer le mot de passe"
                        type="password"
                        placeholder="Confirmez votre mot de passe"
                        autocomplete="new-password"
                        required="true"
                    />

                    <x-form-input
                        name="image"
                        label="Image de profil (Optionnel)"
                        type="file"
                        accept="image/*"
                    />

                    <x-form-button
                        text="Créer le compte"
                        :icon="$createAccountIcon"
                    />
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Vous avez déjà un compte ?
                        <a href="{{ route('login.index') }}" class="font-medium text-blue-600 hover:text-blue-500">
                            Connectez-vous ici
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Initialize password strength checker
            const passwordInput = document.getElementById('password');
            if (passwordInput) {
                passwordInput.addEventListener('input', function () {
                    checkPasswordStrength(this.value);
                });
            } else {
                console.error('Password input not found');
            }

            // Initialize image preview handler
            const imageInput = document.getElementById('image');
            if (imageInput) {
                imageInput.addEventListener('change', function () {
                    previewImage(this);
                });
            } else {
                console.error('Image input not found');
            }
        });

        function previewImage(input) {
            // Find the preview element using the input's ID
            const previewId = 'image-preview-' + input.id;
            const preview = document.getElementById(previewId);

            if (!preview) {
                console.error('Preview element not found for input:', input.id);
                return;
            }

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    preview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover rounded-full">`;
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.innerHTML = `
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                `;
            }
        }

        function checkPasswordStrength(password) {
            // Define regex patterns
            const hasUppercase = /[A-Z]/.test(password);
            const hasLowercase = /[a-z]/.test(password);
            const hasNumber = /\d/.test(password);
            const hasSpecial = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password);
            const hasLength = password.length >= 8;

            // Update checkboxes with animations
            updateCheck('uppercase-check', 'uppercase-text', hasUppercase);
            updateCheck('lowercase-check', 'lowercase-text', hasLowercase);
            updateCheck('number-check', 'number-text', hasNumber);
            updateCheck('special-check', 'special-text', hasSpecial);
            updateCheck('length-check', 'length-text', hasLength);

            // Calculate strength
            const checks = [hasUppercase, hasLowercase, hasNumber, hasSpecial, hasLength];
            const passedChecks = checks.filter(Boolean).length;
            const strengthPercentage = (passedChecks / 5) * 100;

            // Update strength bar and text
            updateStrengthBar(strengthPercentage, passedChecks);
        }

        function updateCheck(checkId, textId, isValid) {
            const checkElement = document.getElementById(checkId);
            const textElement = document.getElementById(textId);

            if (!checkElement || !textElement) {
                return;
            }

            const icon = checkElement.querySelector('svg');

            if (isValid) {
                // Animate to success state
                checkElement.classList.remove('border-gray-300');
                checkElement.classList.add('border-green-500', 'bg-green-500');
                icon.classList.remove('opacity-0');
                icon.classList.add('opacity-100');
                textElement.classList.remove('text-gray-600');
                textElement.classList.add('text-green-600');

                // Add a subtle bounce animation
                checkElement.style.transform = 'scale(1.1)';
                setTimeout(() => {
                    checkElement.style.transform = 'scale(1)';
                }, 150);
            } else {
                // Reset to default state
                checkElement.classList.remove('border-green-500', 'bg-green-500');
                checkElement.classList.add('border-gray-300');
                icon.classList.remove('opacity-100');
                icon.classList.add('opacity-0');
                textElement.classList.remove('text-green-600');
                textElement.classList.add('text-gray-600');
                checkElement.style.transform = 'scale(1)';
            }
        }

        function updateStrengthBar(percentage, passedChecks) {
            const strengthBar = document.getElementById('strength-bar');
            const strengthText = document.getElementById('strength-text');

            if (!strengthBar || !strengthText) {
                return;
            }

            // Update bar width with smooth animation
            strengthBar.style.width = percentage + '%';

            // Update colors and text based on strength
            if (passedChecks <= 1) {
                strengthBar.className = 'h-2 rounded-full transition-all duration-500 ease-out bg-red-500';
                strengthText.textContent = 'Très faible';
                strengthText.className = 'text-xs font-medium text-red-500';
            } else if (passedChecks === 2) {
                strengthBar.className = 'h-2 rounded-full transition-all duration-500 ease-out bg-orange-500';
                strengthText.textContent = 'Faible';
                strengthText.className = 'text-xs font-medium text-orange-500';
            } else if (passedChecks === 3) {
                strengthBar.className = 'h-2 rounded-full transition-all duration-500 ease-out bg-yellow-500';
                strengthText.textContent = 'Moyen';
                strengthText.className = 'text-xs font-medium text-yellow-600';
            } else if (passedChecks === 4) {
                strengthBar.className = 'h-2 rounded-full transition-all duration-500 ease-out bg-blue-500';
                strengthText.textContent = 'Bon';
                strengthText.className = 'text-xs font-medium text-blue-500';
            } else {
                strengthBar.className = 'h-2 rounded-full transition-all duration-500 ease-out bg-green-500';
                strengthText.textContent = 'Fort';
                strengthText.className = 'text-xs font-medium text-green-500';
            }
        }
    </script>
@endsection
