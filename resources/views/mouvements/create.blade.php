<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Enregistrer un mouvement de stock') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('mouvements.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Produit -->
                            <div>
                                <x-input-label for="produit_id" :value="__('Produit')" />
                                <select id="produit_id" name="produit_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">Sélectionner un produit</option>
                                    @foreach ($produits as $produit)
                                        <option value="{{ $produit->id }}" {{ old('produit_id') == $produit->id ? 'selected' : '' }}>
                                            {{ $produit->reference }} - {{ $produit->designation ?? $produit->nom }} (Stock: {{ $produit->stock_actuel }})
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('produit_id')" class="mt-2" />
                            </div>

                            <!-- Type de mouvement -->
                            <div>
                                <x-input-label for="type" :value="__('Type de mouvement')" />
                                <select id="type" name="type" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="entree" {{ old('type') == 'entree' ? 'selected' : '' }}>Entrée (Achat / Approvisionnement)</option>
                                    <option value="sortie" {{ old('type') == 'sortie' ? 'selected' : '' }}>Sortie (Vente / Consommation)</option>
                                    <option value="ajustement" {{ old('type') == 'ajustement' ? 'selected' : '' }}>Ajustement (Inventaire)</option>
                                </select>
                                <x-input-error :messages="$errors->get('type')" class="mt-2" />
                            </div>

                            <!-- Quantite -->
                            <div>
                                <x-input-label for="quantite" :value="__('Quantité')" />
                                <x-text-input id="quantite" class="block mt-1 w-full" type="number" name="quantite" min="1" :value="old('quantite')" required />
                                <x-input-error :messages="$errors->get('quantite')" class="mt-2" />
                            </div>

                            <!-- Prix Unitaire (Modifié de valeur_unitaire à prix_unit pour correspondre au contrôleur) -->
                            <div>
                                <x-input-label for="prix_unit" :value="__('Prix unitaire (FCFA)')" />
                                <x-text-input id="prix_unit" class="block mt-1 w-full" type="number" step="0.01" name="prix_unit" :value="old('prix_unit')" placeholder="Laisser vide ou saisir pour une entrée" />
                                <x-input-error :messages="$errors->get('prix_unit')" class="mt-2" />
                            </div>

                            <!-- Motif -->
                            <div class="md:col-span-2">
                                <x-input-label for="motif" :value="__('Motif / Référence (Facultatif)')" />
                                <x-text-input id="motif" class="block mt-1 w-full" type="text" name="motif" :value="old('motif')" placeholder="Ex: Facture fournisseur N°..." />
                                <x-input-error :messages="$errors->get('motif')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('mouvements.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Annuler</a>
                            <x-primary-button>
                                {{ __('Valider le mouvement') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>