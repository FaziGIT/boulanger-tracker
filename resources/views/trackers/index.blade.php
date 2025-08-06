@extends('base')

@section('title', 'Mes Produits Suivis')

@section('content')
    <div class="p-4 md:p-6">
        <div class="mb-6 md:mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Mes Produits Suivis</h1>
                    <p class="text-gray-600 text-sm md:text-base">Gérez et suivez les prix de vos produits préférés sur
                        Boulanger.</p>
                </div>
                <button
                    onclick="openAddProductModal()"
                    class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-medium text-white text-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200 justify-center"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Ajouter un produit
                </button>
            </div>
        </div>

        <!-- Products Grid -->
        @if($products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6">
                @foreach($products as $product)
                    <div
                        class="product-card rounded-lg shadow-sm border overflow-hidden hover:shadow-md transition-all duration-200
                        @if($product->is_ended)
                            bg-gray-100 border-gray-300 opacity-90
                        @elseif(!$product->is_active)
                            bg-gray-100 border-gray-300 opacity-90
                        @else
                            bg-white border-gray-200
                        @endif">
                        <!-- Product Image -->
                        <div class="aspect-w-16 aspect-h-9 bg-gray-100 relative">
                            @if($product->image)
                                <img src="{{ $product->image }}" alt="{{ $product->name }}"
                                     class="w-full h-48 object-cover
                                     @if($product->is_ended)
                                         filter grayscale opacity-80
                                     @elseif(!$product->is_active)
                                         filter grayscale opacity-80
                                     @endif">
                            @else
                                <div class="w-full h-48 flex items-center justify-center
                                @if($product->is_ended)
                                    bg-gray-200
                                @elseif(!$product->is_active)
                                    bg-gray-200
                                @else
                                    bg-gray-100
                                @endif">
                                    <svg class="w-12 h-12
                                    @if($product->is_ended)
                                        text-gray-400
                                    @elseif(!$product->is_active)
                                        text-gray-400
                                    @else
                                        text-gray-400
                                    @endif" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif

                            <!-- Status overlay for inactive or ended products -->
                            @if($product->is_ended)
                                <div class="absolute inset-0 bg-opacity-40 flex items-center justify-center">
                                    <div
                                        class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow-lg">
                                        Terminé
                                    </div>
                                </div>
                            @elseif(!$product->is_active)
                                <div class="absolute inset-0 bg-opacity-30 flex items-center justify-center">
                                    <div
                                        class="bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow-lg">
                                        Inactif
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="p-4">
                            <div class="flex items-start justify-between mb-2">
                                <h3 class="text-sm md:text-base font-semibold line-clamp-2
                                @if($product->is_ended)
                                    text-gray-500
                                @elseif(!$product->is_active)
                                    text-gray-600
                                @else
                                    text-gray-900
                                @endif">{{ $product->name }}</h3>
                                <div class="flex items-center space-x-1 ml-2">
                                    @if($product->is_active)
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Actif
                                        </span>
                                    @elseif($product->is_ended)
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Terminé
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            Inactif
                                        </span>
                                    @endif
                                </div>
                            </div>

                            @if($product->description)
                                <p class="text-xs md:text-sm mb-3 line-clamp-2
                                @if($product->is_ended)
                                    text-gray-400
                                @elseif(!$product->is_active)
                                    text-gray-500
                                @else
                                    text-gray-600
                                @endif">
                                    {{ $product->description }}
                                </p>
                            @endif

                            <!-- Price Information -->
                            <div class="mb-3">
                                <div class="flex items-center space-x-2">
                                    <span class="text-lg md:text-xl font-bold
                                    @if($product->is_ended)
                                        text-gray-500
                                    @elseif(!$product->is_active)
                                        text-gray-600
                                    @else
                                        text-gray-900
                                    @endif">{{ number_format($product->price, 2) }}€</span>
                                    @if($product->old_price && $product->old_price > $product->price)
                                        <span class="text-sm
                                        @if($product->is_ended)
                                            text-gray-400
                                        @elseif(!$product->is_active)
                                            text-gray-400
                                        @else
                                            text-gray-500
                                        @endif line-through">{{ number_format($product->old_price, 2) }}€</span>
                                        @if($product->discount > 0)
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                                @if($product->is_ended)
                                                    bg-red-50 text-red-600
                                                @elseif(!$product->is_active)
                                                    bg-red-75 text-red-700
                                                @else
                                                    bg-red-100 text-red-800
                                                @endif">
                                                -{{ $product->discount }}%
                                            </span>
                                        @endif
                                    @endif
                                </div>
                            </div>

                            <!-- Frequency Button -->
                            <div class="mb-4">
                                <button
                                    @if(!$product->is_ended) onclick="openFrequencyModal('{{ $product->id }}', '{{ $product->frequency }}')"
                                    @endif
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium transition-colors duration-200
                                        @if($product->is_ended)
                                            bg-gray-100 text-gray-500 cursor-not-allowed
                                        @elseif(!$product->is_active)
                                            bg-gray-100 text-gray-600 hover:bg-gray-200
                                        @else
                                            bg-blue-100 text-blue-800 hover:bg-blue-200
                                        @endif focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg class="w-3 h-3 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75"/>
                                    </svg>
                                    {{ $product->arrayFrequencies[$product->frequency] ?? $product->frequency }}
                                </button>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col space-y-2">
                                @if($product->url)
                                    <a href="{{ $product->url }}" target="_blank" rel="noopener noreferrer"
                                       class="inline-flex items-center justify-center px-2 md:px-3 py-2 border border-gray-300 shadow-sm text-xs md:text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                        Voir le produit
                                    </a>
                                @endif

                                <div class="grid grid-cols-5 gap-1 md:gap-2">
                                    <button
                                        @if(!$product->is_ended) onclick="toggleProductStatus('{{ $product->id }}')"
                                        @endif
                                        class="col-span-2 inline-flex items-center justify-center px-1 md:px-2 py-2 border shadow-sm text-xs font-medium rounded-md transition-colors duration-200
                                        @if($product->is_ended)
                                            border-gray-200 text-gray-400 bg-gray-50 cursor-not-allowed
                                        @else
                                            border-gray-300 text-gray-700 bg-white hover:bg-gray-50 cursor-pointer
                                        @endif focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <svg class="w-3 h-3 md:w-4 md:h-4 mr-1" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                        {{ $product->is_active ? 'Désactiver' : 'Activer' }}
                                    </button>

                                    <button
                                        @if(!$product->is_ended) onclick="openEndProductModal('{{ $product->id }}', '{{ addslashes($product->name) }}')"
                                        @endif
                                        class="col-span-2 inline-flex items-center justify-center px-1 md:px-2 py-2 border shadow-sm text-xs font-medium rounded-md transition-colors duration-200
                                        @if($product->is_ended)
                                            border-green-200 text-green-400 bg-green-50 cursor-not-allowed
                                        @else
                                            border-green-300 text-green-700 bg-white hover:bg-green-50 cursor-pointer
                                        @endif focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        <svg class="w-3 h-3 md:w-4 md:h-4 mr-1" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Terminé
                                    </button>

                                    <button
                                        onclick="openDeleteProductModal('{{ $product->id }}', '{{ addslashes($product->name) }}')"
                                        class="col-span-1 inline-flex items-center justify-center px-1 md:px-2 py-2 border border-red-300 shadow-sm text-xs font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200 cursor-pointer">
                                        <svg class="w-3 h-3 md:w-4 md:h-4" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun produit suivi</h3>
                <p class="mt-1 text-sm text-gray-500">Commencez par ajouter votre premier produit à suivre.</p>
                <div class="mt-6">
                    <button
                        onclick="openAddProductModal()"
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Ajouter un produit
                    </button>
                </div>
            </div>
        @endif
    </div>

    <!-- Add Product Modal -->
    <div id="addProductModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title"
         role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center md:block md:p-0">
            <!-- Background overlay -->
            <div id="modalOverlay"
                 class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity duration-300 opacity-0"
                 aria-hidden="true" onclick="closeAddProductModal()"></div>

            <!-- Modal panel -->
            <div id="modalPanel"
                 class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all duration-300 md:my-8 md:align-middle md:max-w-md md:w-full w-full max-w-sm mx-auto opacity-0 scale-95 translate-y-4">
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="bg-white px-4 md:px-6 pt-6 pb-4">
                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <h3 class="text-lg font-medium text-gray-900" id="modal-title">
                                    Ajouter un nouveau produit
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    Entrez l'URL du produit Boulanger que vous souhaitez suivre.
                                </p>
                                <div class="mt-6 space-y-4">
                                    <x-form-input
                                        name="url"
                                        label="URL du produit Boulanger"
                                        placeholder="https://www.boulanger.com/..."
                                        required="true"
                                        value="{{ old('url') }}"
                                        :error="$errors->first('url')"
                                    />

                                    @php
                                        use App\Models\Product;
                                        $choices = Product::arrayFrequencies;
                                    @endphp

                                    <x-form-select
                                        name="frequency"
                                        label="Fréquence de vérification"
                                        :options="$choices"
                                        required="true"
                                        placeholder="Choisir la fréquence"
                                        :selected="old('frequency')"
                                        :error="$errors->first('frequency')"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-gray-50 px-4 md:px-6 py-4 flex flex-col md:flex-row justify-between items-center space-y-3 md:space-y-0">
                        <button
                            type="button"
                            class="w-full md:w-32 inline-flex justify-center items-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200 cursor-pointer"
                            onclick="closeAddProductModal()"
                        >
                            Annuler
                        </button>
                        <button
                            type="submit"
                            class="w-full md:w-32 inline-flex justify-center items-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200 cursor-pointer"
                        >
                            Ajouter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Change Frequency Modal -->
    <div id="frequencyModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="frequency-modal-title"
         role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center md:block md:p-0">
            <!-- Background overlay -->
            <div id="frequencyModalOverlay"
                 class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity duration-300 opacity-0"
                 aria-hidden="true" onclick="closeFrequencyModal()"></div>

            <!-- Modal panel -->
            <div id="frequencyModalPanel"
                 class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all duration-300 md:my-8 md:align-middle md:max-w-md md:w-full w-full max-w-sm mx-auto opacity-0 scale-95 translate-y-4">
                <form id="frequencyForm" method="POST">
                    <div class="bg-white px-4 md:px-6 pt-6 pb-4">
                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                                <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75"/>
                                </svg>

                            </div>
                            <div class="ml-4 flex-1">
                                <h3 class="text-lg font-medium text-gray-900" id="frequency-modal-title">
                                    Changer la fréquence
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    Choisissez la nouvelle fréquence de vérification pour ce produit.
                                </p>
                                @csrf
                                @method('PATCH')
                                <div class="mt-6 space-y-4">
                                    @php
                                        $frequencyChoices = Product::arrayFrequencies;
                                    @endphp

                                    <x-form-select
                                        name="frequency"
                                        label="Fréquence de vérification"
                                        :options="$frequencyChoices"
                                        required="true"
                                        placeholder="Choisir la fréquence"
                                        :selected="old('frequency')"
                                        :error="$errors->first('frequency')"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-gray-50 px-4 md:px-6 py-4 flex flex-col md:flex-row justify-between items-center space-y-3 md:space-y-0">
                        <button
                            type="button"
                            class="w-full md:w-32 inline-flex justify-center items-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200 cursor-pointer"
                            onclick="closeFrequencyModal()"
                        >
                            Annuler
                        </button>
                        <button
                            type="submit"
                            class="w-full md:w-32 inline-flex justify-center items-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200 cursor-pointer"
                        >
                            Modifier
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- End Product Confirmation Modal -->
    <div id="endProductModal" class="fixed inset-0 z-50 overflow-y-auto hidden"
         aria-labelledby="end-product-modal-title"
         role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center md:block md:p-0">
            <!-- Background overlay -->
            <div id="endProductModalOverlay"
                 class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity duration-300 opacity-0"
                 aria-hidden="true" onclick="closeEndProductModal()"></div>

            <!-- Modal panel -->
            <div id="endProductModalPanel"
                 class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all duration-300 md:my-8 md:align-middle md:max-w-md md:w-full w-full max-w-sm mx-auto opacity-0 scale-95 translate-y-4">
                <form id="endProductForm" method="POST">
                    <div class="bg-white px-4 md:px-6 pt-6 pb-4">
                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                                <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75"/>
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <h3 class="text-lg font-medium text-gray-900" id="end-product-modal-title">
                                    Confirmation de terminaison
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    Pour confirmer la terminaison de ce produit, veuillez retaper le nom du produit.
                                </p>
                                <div class="mt-3 p-3 bg-gray-50 rounded-lg">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm text-gray-600 mb-1">Nom du produit à retaper :</p>
                                            <p class="text-sm font-medium text-gray-900" id="product-name-display"></p>
                                        </div>
                                    </div>

                                    <!-- Copy input field with button -->
                                    <div class="w-full">
                                        <div class="relative">
                                            <input
                                                id="product-name-input"
                                                type="text"
                                                class="col-span-6 bg-white border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-12"
                                                value=""
                                                disabled
                                                readonly
                                                placeholder=""
                                            >
                                            <button
                                                id="copy-product-name-btn"
                                                class="absolute end-2 top-1/2 -translate-y-1/2 text-gray-500 hover:bg-gray-100 rounded-lg p-2 inline-flex items-center justify-center transition-all duration-200 cursor-pointer"
                                            >
                                                <span id="default-icon">
                                                    <svg class="w-4 h-4" aria-hidden="true"
                                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                         viewBox="0 0 18 20">
                                                        <path
                                                            d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z"/>
                                                    </svg>
                                                </span>
                                                <span id="success-icon" class="hidden">
                                                    <svg class="w-4 h-4 text-green-600" aria-hidden="true"
                                                         xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 16 12">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                              stroke-linejoin="round" stroke-width="2"
                                                              d="M1 5.917 5.724 10.5 15 1.5"/>
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
                                        <div id="copy-tooltip"
                                             class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-lg opacity-0 mt-2"
                                             style="top: -40px; left: 50%; transform: translateX(-50%);">
                                            <span id="default-tooltip-message">Copier le nom</span>
                                            <span id="success-tooltip-message" class="hidden">Copié !</span>
                                        </div>
                                    </div>
                                </div>
                                @csrf
                                @method('PATCH')
                                <div class="mt-6 space-y-4 px-3">
                                    <div>
                                        <label for="product_name" class="block text-sm font-medium text-gray-700 mb-2">
                                            Nom du produit
                                        </label>
                                        <input
                                            type="text"
                                            name="product_name"
                                            id="product_name"
                                            placeholder="Ex: Produit de test"
                                            required
                                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                            oninput="validateProductName()"
                                        >
                                        @error('product_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-gray-50 px-4 md:px-6 py-4 flex flex-col md:flex-row justify-between items-center space-y-3 md:space-y-0">
                        <button
                            type="button"
                            class="w-full md:w-32 inline-flex justify-center items-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200 cursor-pointer"
                            onclick="closeEndProductModal()"
                        >
                            Annuler
                        </button>
                        <button
                            type="submit"
                            id="confirm-end-button"
                            class="w-full md:w-32 inline-flex justify-center items-center rounded-lg border border-transparent shadow-sm px-4 py-2 text-sm font-medium transition-colors duration-200 cursor-not-allowed opacity-50 bg-gray-300 text-gray-500"
                            disabled
                        >
                            Confirmer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Product Confirmation Modal -->
    <div id="deleteProductModal" class="fixed inset-0 z-50 overflow-y-auto hidden"
         aria-labelledby="delete-product-modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center md:block md:p-0">
            <!-- Background overlay -->
            <div id="deleteProductModalOverlay"
                 class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity duration-300 opacity-0"
                 aria-hidden="true" onclick="closeDeleteProductModal()"></div>
            <!-- Modal panel -->
            <div id="deleteProductModalPanel"
                 class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all duration-300 md:my-8 md:align-middle md:max-w-md md:w-full w-full max-w-sm mx-auto opacity-0 scale-95 translate-y-4">
                <form id="deleteProductForm" method="POST">
                    <div class="bg-white px-4 md:px-6 pt-6 pb-4">
                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                                <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <h3 class="text-lg font-medium text-gray-900" id="delete-product-modal-title">
                                    Confirmation de suppression
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    Pour confirmer la suppression de ce produit, veuillez retaper le nom du produit.
                                </p>
                                <div class="mt-3 p-3 bg-gray-50 rounded-lg">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm text-gray-600 mb-1">Nom du produit à retaper :</p>
                                            <p class="text-sm font-medium text-gray-900"
                                               id="delete-product-name-display"></p>
                                        </div>
                                    </div>
                                    <div class="w-full mt-2">
                                        <div class="relative">
                                            <input
                                                id="delete-product-name-input"
                                                type="text"
                                                class="bg-white border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 pr-12"
                                                value=""
                                                disabled
                                                readonly
                                                placeholder=""
                                            >
                                            <button
                                                id="copy-delete-product-name-btn"
                                                class="absolute end-2 top-1/2 -translate-y-1/2 text-gray-500 hover:bg-gray-100 rounded-lg p-2 inline-flex items-center justify-center transition-all duration-200 cursor-pointer"
                                            >
                                            <span id="delete-default-icon">
                                                <svg class="w-4 h-4" aria-hidden="true"
                                                     xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                     viewBox="0 0 18 20">
                                                    <path
                                                        d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z"/>
                                                </svg>
                                            </span>
                                                <span id="delete-success-icon" class="hidden">
                                                <svg class="w-4 h-4 text-green-600" aria-hidden="true"
                                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                          stroke-linejoin="round" stroke-width="2"
                                                          d="M1 5.917 5.724 10.5 15 1.5"/>
                                                </svg>
                                            </span>
                                            </button>
                                        </div>
                                        <div id="delete-copy-tooltip"
                                             class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-lg opacity-0 mt-2"
                                             style="top: -40px; left: 50%; transform: translateX(-50%);">
                                            <span id="delete-default-tooltip-message">Copier le nom</span>
                                            <span id="delete-success-tooltip-message" class="hidden">Copié !</span>
                                        </div>
                                    </div>
                                </div>
                                @csrf
                                @method('DELETE')
                                <div class="mt-6 space-y-4 px-3">
                                    <div>
                                        <label for="delete_product_name"
                                               class="block text-sm font-medium text-gray-700 mb-2">
                                            Nom du produit
                                        </label>
                                        <input
                                            type="text"
                                            name="delete_product_name"
                                            id="delete_product_name"
                                            placeholder="Ex: Produit de test"
                                            required
                                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                                            oninput="validateDeleteProductName()"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-gray-50 px-4 md:px-6 py-4 flex flex-col md:flex-row justify-between items-center space-y-3 md:space-y-0">
                        <button
                            type="button"
                            class="w-full md:w-32 inline-flex justify-center items-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200 cursor-pointer"
                            onclick="closeDeleteProductModal()"
                        >
                            Annuler
                        </button>
                        <button
                            type="submit"
                            id="confirm-delete-button"
                            class="w-full md:w-32 inline-flex justify-center items-center rounded-lg border border-transparent shadow-sm px-4 py-2 text-sm font-medium transition-colors duration-200 cursor-not-allowed opacity-50 bg-gray-300 text-gray-500"
                            disabled
                        >
                            Supprimer
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <style>
            @keyframes modalFadeIn {
                from {
                    opacity: 0;
                    transform: scale(0.95) translateY(1rem);
                }
                to {
                    opacity: 1;
                    transform: scale(1) translateY(0);
                }
            }

            @keyframes overlayFadeIn {
                from {
                    opacity: 0;
                }
                to {
                    opacity: 0.75;
                }
            }

            .modal-open {
                animation: modalFadeIn 0.3s ease-out forwards;
            }

            .overlay-open {
                animation: overlayFadeIn 0.3s ease-out forwards;
            }

            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .product-card {
                transition: all 0.2s ease-in-out;
            }

            .product-card:hover {
                transform: translateY(-2px);
            }

            .aspect-w-16 {
                position: relative;
                padding-bottom: 56.25%; /* 16:9 aspect ratio */
            }

            .aspect-w-16 > * {
                position: absolute;
                height: 100%;
                width: 100%;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
            }
        </style>

        <script>
            // Variables globales
            let currentProductName = '';
            let currentDeleteProductName = '';

            // Fonctions génériques pour les modales
            function openModal(modalId, overlayId, panelId) {
                const modal = document.getElementById(modalId);
                const overlay = document.getElementById(overlayId);
                const panel = document.getElementById(panelId);
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                setTimeout(() => {
                    overlay.classList.add('overlay-open');
                    panel.classList.add('modal-open');
                }, 10);
            }

            function closeModal(modalId, overlayId, panelId) {
                const modal = document.getElementById(modalId);
                const overlay = document.getElementById(overlayId);
                const panel = document.getElementById(panelId);
                overlay.classList.remove('overlay-open');
                panel.classList.remove('modal-open');
                setTimeout(() => {
                    modal.classList.add('hidden');
                    document.body.style.overflow = 'auto';
                }, 300);
            }

            // Fonctions spécifiques pour chaque modale
            function openAddProductModal() {
                openModal('addProductModal', 'modalOverlay', 'modalPanel');
            }

            function closeAddProductModal() {
                closeModal('addProductModal', 'modalOverlay', 'modalPanel');
            }

            function openFrequencyModal(productId, currentFrequency) {
                const form = document.getElementById('frequencyForm');
                const select = form.querySelector('select[name="frequency"]');
                form.action = `/products/${productId}/update-frequency`;
                select.value = currentFrequency;
                openModal('frequencyModal', 'frequencyModalOverlay', 'frequencyModalPanel');
            }

            function closeFrequencyModal() {
                closeModal('frequencyModal', 'frequencyModalOverlay', 'frequencyModalPanel');
            }

            function openEndProductModal(productId, productName) {
                const form = document.getElementById('endProductForm');
                const input = form.querySelector('input[name="product_name"]');
                const confirmButton = document.getElementById('confirm-end-button');
                const copyInput = document.getElementById('product-name-input');
                form.action = `/products/${productId}/end`;
                currentProductName = productName;
                copyInput.value = productName;
                input.value = '';
                resetButton(confirmButton, 'blue');
                openModal('endProductModal', 'endProductModalOverlay', 'endProductModalPanel');
            }

            function closeEndProductModal() {
                closeModal('endProductModal', 'endProductModalOverlay', 'endProductModalPanel');
            }

            function openDeleteProductModal(productId, productName) {
                const form = document.getElementById('deleteProductForm');
                const input = form.querySelector('input[name="delete_product_name"]');
                const productNameDisplay = document.getElementById('delete-product-name-display');
                const confirmButton = document.getElementById('confirm-delete-button');
                const copyInput = document.getElementById('delete-product-name-input');
                form.action = `/products/${productId}`;
                currentDeleteProductName = productName;
                productNameDisplay.textContent = productName;
                copyInput.value = productName;
                input.value = '';
                resetButton(confirmButton, 'red');
                openModal('deleteProductModal', 'deleteProductModalOverlay', 'deleteProductModalPanel');
            }

            function closeDeleteProductModal() {
                closeModal('deleteProductModal', 'deleteProductModalOverlay', 'deleteProductModalPanel');
            }

            // Fonctions génériques pour les boutons
            function resetButton(button, color) {
                button.disabled = true;
                const colorClasses = {
                    blue: ['cursor-pointer', 'bg-blue-600', 'text-white', 'hover:bg-blue-700', 'focus:outline-none', 'focus:ring-2', 'focus:ring-offset-2', 'focus:ring-blue-500'],
                    red: ['cursor-pointer', 'bg-red-600', 'text-white', 'hover:bg-red-700', 'focus:outline-none', 'focus:ring-2', 'focus:ring-offset-2', 'focus:ring-red-500']
                };
                button.classList.remove(...colorClasses[color]);
                button.classList.add('cursor-not-allowed', 'opacity-50', 'bg-gray-300', 'text-gray-500');
            }

            function enableButton(button, color) {
                button.disabled = false;
                const colorClasses = {
                    blue: ['cursor-pointer', 'bg-blue-600', 'text-white', 'hover:bg-blue-700', 'focus:outline-none', 'focus:ring-2', 'focus:ring-offset-2', 'focus:ring-blue-500'],
                    red: ['cursor-pointer', 'bg-red-600', 'text-white', 'hover:bg-red-700', 'focus:outline-none', 'focus:ring-2', 'focus:ring-offset-2', 'focus:ring-red-500']
                };
                button.classList.remove('cursor-not-allowed', 'opacity-50', 'bg-gray-300', 'text-gray-500');
                button.classList.add(...colorClasses[color]);
            }

            // Fonctions génériques pour la copie
            function copyText(text, prefix = '') {
                if (!text) {
                    alert('Aucun nom de produit à copier.');
                    return;
                }
                navigator.clipboard.writeText(text);
                showCopySuccess(prefix);
                setTimeout(() => {
                    resetCopyToDefault(prefix);
                }, 2000);
            }

            function showCopySuccess(prefix = '') {
                const elements = {
                    defaultIcon: document.getElementById(prefix + 'default-icon'),
                    successIcon: document.getElementById(prefix + 'success-icon'),
                    defaultTooltip: document.getElementById(prefix + 'default-tooltip-message'),
                    successTooltip: document.getElementById(prefix + 'success-tooltip-message'),
                    tooltip: document.getElementById(prefix + 'copy-tooltip')
                };
                elements.defaultIcon.classList.add('hidden');
                elements.successIcon.classList.remove('hidden');
                elements.defaultTooltip.classList.add('hidden');
                elements.successTooltip.classList.remove('hidden');
                elements.tooltip.classList.remove('hide');
                elements.tooltip.classList.add('show');
            }

            function resetCopyToDefault(prefix = '') {
                const elements = {
                    defaultIcon: document.getElementById(prefix + 'default-icon'),
                    successIcon: document.getElementById(prefix + 'success-icon'),
                    defaultTooltip: document.getElementById(prefix + 'default-tooltip-message'),
                    successTooltip: document.getElementById(prefix + 'success-tooltip-message'),
                    tooltip: document.getElementById(prefix + 'copy-tooltip')
                };
                elements.defaultIcon.classList.remove('hidden');
                elements.successIcon.classList.add('hidden');
                elements.defaultTooltip.classList.remove('hidden');
                elements.successTooltip.classList.add('hidden');
                elements.tooltip.classList.remove('show');
                elements.tooltip.classList.add('hide');
            }

            // Fonctions spécifiques pour la copie
            function copyProductName(event) {
                event.preventDefault();
                event.stopPropagation();
                const button = event.target.closest('button');
                button.classList.add('clicked');
                setTimeout(() => button.classList.remove('clicked'), 200);
                copyText(currentProductName);
            }

            function copyDeleteProductName(event) {
                event.preventDefault();
                event.stopPropagation();
                const button = event.target.closest('button');
                button.classList.add('clicked');
                setTimeout(() => button.classList.remove('clicked'), 200);
                copyText(currentDeleteProductName, 'delete-');
            }

            // Fonctions de validation
            function validateProductName() {
                const input = document.getElementById('product_name');
                const confirmButton = document.getElementById('confirm-end-button');
                const enteredName = input.value.trim();
                if (enteredName === currentProductName) {
                    enableButton(confirmButton, 'blue');
                } else {
                    resetButton(confirmButton, 'blue');
                }
            }

            function validateDeleteProductName() {
                const input = document.getElementById('delete_product_name');
                const confirmButton = document.getElementById('confirm-delete-button');
                const enteredName = input.value.trim();
                if (enteredName === currentDeleteProductName) {
                    enableButton(confirmButton, 'red');
                } else {
                    resetButton(confirmButton, 'red');
                }
            }

            // Fonctions d'action
            function toggleProductStatus(product) {
                fetch(`/products/${product}/toggle-status`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                }).then(() => window.location.reload());
            }

            // Event listeners
            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    closeAddProductModal();
                    closeFrequencyModal();
                    closeEndProductModal();
                    closeDeleteProductModal();
                }
            });

            document.getElementById('frequencyForm').addEventListener('submit', function (e) {
                e.preventDefault();
                const formData = new FormData(this);
                fetch(this.action, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        frequency: formData.get('frequency')
                    })
                }).then(() => {
                    closeFrequencyModal();
                    window.location.reload();
                }).catch(() => window.location.reload());
            });

            document.getElementById('endProductForm').addEventListener('submit', function (e) {
                e.preventDefault();
                const formData = new FormData(this);
                const enteredName = formData.get('product_name');
                if (enteredName !== currentProductName) {
                    alert('Le nom saisi ne correspond pas au nom du produit. Veuillez vérifier et réessayer.');
                    return;
                }
                fetch(this.action, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        product_name: enteredName
                    })
                }).then(() => {
                    closeEndProductModal();
                    window.location.reload();
                }).catch(error => {
                    console.error('Error:', error);
                    window.location.reload();
                });
            });

            document.getElementById('deleteProductForm').addEventListener('submit', function (e) {
                e.preventDefault();
                const formData = new FormData(this);
                const enteredName = formData.get('delete_product_name');
                if (enteredName !== currentDeleteProductName) {
                    alert('Le nom saisi ne correspond pas au nom du produit. Veuillez vérifier et réessayer.');
                    return;
                }
                fetch(this.action, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        delete_product_name: enteredName
                    })
                }).then(() => window.location.reload()).catch(error => {
                    console.error('Error:', error);
                    window.location.reload();
                });
            });

            // Initialisation
            @if($errors->any())
            document.addEventListener('DOMContentLoaded', () => openAddProductModal());
            @endif

            document.addEventListener('DOMContentLoaded', function () {
                const copyButton = document.getElementById('copy-product-name-btn');
                const copyDeleteButton = document.getElementById('copy-delete-product-name-btn');
                if (copyButton) copyButton.addEventListener('click', copyProductName);
                if (copyDeleteButton) copyDeleteButton.addEventListener('click', copyDeleteProductName);
            });
        </script>
@endsection
