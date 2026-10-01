<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un nouveau produit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <!-- Affichage des erreurs de validation -->
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('produits.store') }}">
                    @csrf

                    <!-- Catégorie -->
                    <div class="mb-4">
                        <label for="category_id" class="block font-medium text-sm text-gray-700">Catégorie</label>
                        <select name="category_id" id="category_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1" required>
                            <option value="">-- Sélectionner une catégorie --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->libelle ?? $category->name ?? $category->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Référence -->
                    <div class="mb-4">
                        <label for="reference" class="block font-medium text-sm text-gray-700">Référence</label>
                        <input type="text" name="reference" id="reference" value="{{ old('reference') }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1" required>
                    </div>

                    <!-- Désignation -->
                    <div class="mb-4">
                        <label for="designation" class="block font-medium text-sm text-gray-700">Désignation</label>
                        <input type="text" name="designation" id="designation" value="{{ old('designation') }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1" required>
                    </div>

                    <!-- Prix d'achat -->
                    <div class="mb-4">
                        <label for="prix_achat" class="block font-medium text-sm text-gray-700">Prix d'Achat (FCFA)</label>
                        <input type="number" step="0.01" name="prix_achat" id="prix_achat" value="{{ old('prix_achat') }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1" required>
                    </div>

                    <!-- Prix de vente -->
                    <div class="mb-4">
                        <label for="prix_vente" class="block font-medium text-sm text-gray-700">Prix de Vente (FCFA)</label>
                        <input type="number" step="0.01" name="prix_vente" id="prix_vente" value="{{ old('prix_vente') }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1" required>
                    </div>

                    <!-- Stock actuel -->
                    <div class="mb-4">
                        <label for="stock_actuel" class="block font-medium text-sm text-gray-700">Stock Initial</label>
                        <input type="number" name="stock_actuel" id="stock_actuel" value="{{ old('stock_actuel', 0) }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1" required>
                    </div>

                    <!-- Seuil d'alerte -->
                    <div class="mb-4">
                        <label for="seuil_alerte" class="block font-medium text-sm text-gray-700">Seuil d'alerte</label>
                        <input type="number" name="seuil_alerte" id="seuil_alerte" value="{{ old('seuil_alerte', 5) }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1" required>
                    </div>

                    <!-- Méthode de valorisation -->
                    <div class="mb-4">
                        <label for="methode_valorisation" class="block font-medium text-sm text-gray-700">Méthode de valorisation</label>
                        <select name="methode_valorisation" id="methode_valorisation" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1" required>
                            <option value="">-- Sélectionner une méthode --</option>
                            <option value="CUMP" {{ old('methode_valorisation') == 'CUMP' ? 'selected' : '' }}>CUMP (Coût Unitaire Moyen Pondéré)</option>
                            <option value="FIFO" {{ old('methode_valorisation') == 'FIFO' ? 'selected' : '' }}>FIFO (First In, First Out)</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('produits.index') }}" class="text-gray-600 underline mr-4">Annuler</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Enregistrer le produit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>