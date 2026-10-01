<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Creer une nouvelle facture') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="factureForm()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('factures.store') }}">
                        @csrf

                        <!-- Choix du client -->
                        <div class="mb-6">
                            <x-input-label for="tiers_id" :value="__('Client')" />
                            <select id="tiers_id" name="tiers_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">-- Selectionner un client --</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('tiers_id') == $client->id ? 'selected' : '' }}>
                                        {{ $client->nom }} (Tel: {{ $client->telephone ?? 'N/A' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Lignes de facture -->
                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 mb-2">Lignes de produits</label>
                            
                            <template x-for="(ligne, index) in lignes" :key="index">
                                <div class="flex items-center gap-4 mb-3">
                                    <div class="flex-1">
                                        <select :name="`lignes[${index}][produit_id]`" x-model="ligne.produit_id" class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                            <option value="">-- Selectionner un produit --</option>
                                            @foreach ($produits as $produit)
                                                <option value="{{ $produit->id }}" data-prix="{{ $produit->prix_vente }}" data-stock="{{ $produit->stock_actuel }}">
                                                    {{ $produit->reference }} - {{ $produit->designation }} (Stock: {{ $produit->stock_actuel }} | Prix: {{ number_format($produit->prix_vente, 0, ',', ' ') }} FCFA)
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="w-32">
                                        <input type="number" :name="`lignes[${index}][quantite]`" x-model.number="ligne.quantite" min="1" placeholder="Quantite" class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    </div>

                                    <button type="button" @click="removeLigne(index)" class="bg-red-500 hover:bg-red-700 text-white px-3 py-2 rounded-md text-sm" x-show="lignes.length > 1">
                                        Supprimer
                                    </button>
                                </div>
                            </template>

                            <button type="button" @click="addLigne" class="mt-2 bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md text-sm font-medium">
                                + Ajouter une ligne
                            </button>
                        </div>

                        <div class="flex items-center justify-end mt-6 border-t pt-4">
                            <a href="{{ route('factures.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Annuler</a>
                            <x-primary-button>
                                {{ __('Valider et generer la facture') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function factureForm() {
            return {
                lignes: [{ produit_id: '', quantite: 1 }],
                addLigne() {
                    this.lignes.push({ produit_id: '', quantite: 1 });
                },
                removeLigne(index) {
                    this.lignes.splice(index, 1);
                }
            }
        }
    </script>
</x-app-layout>