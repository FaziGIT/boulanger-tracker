@extends('base')

@section('title', 'Mes Produits Suivis')

@section('content')
    <div class="p-6">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Mes Produits Suivis</h1>
            <p class="text-gray-600">Gérez et suivez les prix de vos produits préférés sur Boulanger.</p>
        </div>

        <!-- Empty State -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 text-center">
            <div class="w-16 h-16 bg-gray-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
            <h2 class="text-xl font-semibold text-gray-900 mb-2">Aucun produit suivi</h2>
            <p class="text-gray-600 mb-6">Commencez à suivre vos produits préférés pour ne manquer aucune promotion
                Boulanger.</p>
            <a href="#"
               class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Ajouter mon premier produit
            </a>
        </div>
    </div>
@endsection
