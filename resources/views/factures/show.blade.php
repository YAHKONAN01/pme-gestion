<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Details de la facture') }} : {{ $facture->numero }}
            </h2>
            <a href="{{ route('factures.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                Retour a la liste
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                <!-- En-tete facture -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 border-b pb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-700 mb-2">Informations client</h3>
                        <p><span class="font-semibold">Nom :</span> {{ $facture->tiers->nom ?? 'N/A' }}</p>
                        <p><span class="font-semibold">Telephone :</span> {{ $facture->tiers->telephone ?? 'N/A' }}</p>
                        <p><span class="font-semibold">Adresse :</span> {{ $facture->tiers->adresse ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-700 mb-2">Informations facture</h3>
                        <p><span class="font-semibold">Date :</span> {{ $facture->created_at->format('d/m/Y H:i') }}</p>
                        <p><span class="font-semibold">Statut :</span> {{ ucfirst($facture->statut) }}</p>
                        <p><span class="font-semibold">Auteur :</span> {{ $facture->user->name ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Tableau des lignes -->
                <div class="overflow-x-auto mb-6">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produit</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantite</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prix unitaire</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Montant ligne</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($facture->lignes as $ligne)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $ligne->produit->designation ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $ligne->quantite }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($ligne->prix_unit, 0, ',', ' ') }} FCFA</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ number_format($ligne->montant_ligne, 0, ',', ' ') }} FCFA</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Totaux -->
                <div class="flex justify-end">
                    <div class="w-full md:w-1/3 bg-gray-50 p-4 rounded-lg space-y-2">
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-600">Total HT :</span>
                            <span class="font-semibold">{{ number_format($facture->montant_ht, 0, ',', ' ') }} FCFA</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-600">TVA (18%) :</span>
                            <span class="font-semibold">{{ number_format($facture->montant_tva, 0, ',', ' ') }} FCFA</span>
                        </div>
                        <div class="flex justify-between border-t pt-2 text-lg font-bold text-gray-900">
                            <span>Total TTC :</span>
                            <span>{{ number_format($facture->montant_ttc, 0, ',', ' ') }} FCFA</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>