<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Journal des écritures comptables (SYSCOHADA)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filtre par code journal -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 p-4">
                <form method="GET" action="{{ route('comptabilite.index') }}" class="flex items-center gap-4">
                    <div>
                        <x-input-label for="journal_code" :value="__('Filtrer par Journal')" />
                        <select id="journal_code" name="journal_code" class="block mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">Tous les journaux</option>
                            <option value="VTE" {{ request('journal_code') == 'VTE' ? 'selected' : '' }}>VTE - Ventes</option>
                            <option value="ACH" {{ request('journal_code') == 'ACH' ? 'selected' : '' }}>ACH - Achats</option>
                            <option value="BQ" {{ request('journal_code') == 'BQ' ? 'selected' : '' }}>BQ - Banque</option>
                        </select>
                    </div>
                    <div class="mt-6 flex gap-2">
                        <x-primary-button>
                            {{ __('Filtrer') }}
                        </x-primary-button>
                        <a href="{{ route('comptabilite.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md text-sm font-medium flex items-center">
                            Réinitialiser
                        </a>
                    </div>
                </form>
            </div>

            <!-- Tableau des écritures -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Journal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Compte</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Libellé</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Débit</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Crédit</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($ecritures as $ecriture)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($ecriture->date_ecriture)->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700">{{ $ecriture->journal_code }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $ecriture->compte->numero_compte ?? '-' }} - {{ $ecriture->compte->intitule ?? '' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $ecriture->libelle }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-900">{{ $ecriture->debit > 0 ? number_format($ecriture->debit, 0, ',', ' ') . ' FCFA' : '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-900">{{ $ecriture->credit > 0 ? number_format($ecriture->credit, 0, ',', ' ') . ' FCFA' : '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Aucune écriture comptable enregistrée.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $ecritures->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>