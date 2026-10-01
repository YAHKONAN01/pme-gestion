<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier le produit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('produits.update', $produit->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Reference -->
                            <div>
                                <x-input-label for="reference" :value="__('Reference')" />
                                <x-text-input id="reference" class="block mt-1 w-full" type="text" name="reference" :value="old('reference', $produit->reference)" required autofocus />
                                <x-input-error :messages="$errors->get('reference')" class="mt-2" />
                            </div>

                            <!-- Designation -->
                            <div>
                                <x-input-label for="designation" :value="__('Designation')" />
                                <x-text-input id="designation" class="block mt-1 w-full" type="text" name="designation" :value="old('designation', $produit->designation)" required />
                                <x-input-error :messages="$errors->get('designation')" class="mt-2" />
                            </div>

                            <!-- Categorie -->
                            <div>
                                <x-input-label for="category_id" :value="__('Categorie')" />
                                <select id="category_id" name="category_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    @foreach ($categories as $categorie)
                                        <option value="{{ $categorie->id }}" {{ $produit->category_id == $categorie->id ? 'selected' : '' }}>
                                            {{ $categorie->libelle }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                            </div>

                            <!-- Prix Achat -->
                            <div>
                                <x-input-label for="prix_achat" :value="__('Prix d achat')" />
                                <x-text-input id="prix_achat" class="block mt-1 w-full" type="number" step="0.01" name="prix_achat" :value="old('prix_achat', $produit->prix_achat)" required />
                                <x-input-error :messages="$errors->get('prix_achat')" class="mt-2" />
                            </div>

                            <!-- Prix Vente -->
                            <div>
                                <x-input-label for="prix_vente" :value="__('Prix de vente')" />
                                <x-text-input id="prix_vente" class="block mt-1 w-full" type="number" step="0.01" name="prix_vente" :value="old('prix_vente', $produit->prix_vente)" required />
                                <x-input-error :messages="$errors->get('prix_vente')" class="mt-2" />
                            </div>

                            <!-- Stock Actuel -->
                            <div>
                                <x-input-label for="stock_actuel" :value="__('Stock actuel')" />
                                <x-text-input id="stock_actuel" class="block mt-1 w-full" type="number" name="stock_actuel" :value="old('stock_actuel', $produit->stock_actuel)" required />
                                <x-input-error :messages="$errors->get('stock_actuel')" class="mt-2" />
                            </div>

                            <!-- Seuil Alerte -->
                            <div>
                                <x-input-label for="seuil_alerte" :value="__('Seuil d alerte')" />
                                <x-text-input id="seuil_alerte" class="block mt-1 w-full" type="number" name="seuil_alerte" :value="old('seuil_alerte', $produit->seuil_alerte)" required />
                                <x-input-error :messages="$errors->get('seuil_alerte')" class="mt-2" />
                            </div>

                            <!-- Methode Valorisation -->
                            <div>
                                <x-input-label for="methode_valorisation" :value="__('Methode de valorisation')" />
                                <select id="methode_valorisation" name="methode_valorisation" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="CUMP" {{ $produit->methode_valorisation == 'CUMP' ? 'selected' : '' }}>CUMP</option>
                                    <option value="FIFO" {{ $produit->methode_valorisation == 'FIFO' ? 'selected' : '' }}>FIFO</option>
                                </select>
                                <x-input-error :messages="$errors->get('methode_valorisation')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('produits.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Annuler</a>
                            <x-primary-button>
                                {{ __('Mettre a jour') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>