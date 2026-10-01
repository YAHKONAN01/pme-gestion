<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Balance des comptes (SYSCOHADA)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">N° Compte</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Intitulé</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Total Débit</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Total Crédit</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Solde Débiteur</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Solde Créditeur</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($comptes as $compte)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $compte->numero_compte }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $compte->intitule }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-900">{{ number_format($compte->total_debit, 0, ',', ' ') }} FCFA</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-900">{{ number_format($compte->total_credit, 0, ',', ' ') }} FCFA</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium text-green-600">
                                            {{ $compte->solde > 0 ? number_format($compte->solde, 0, ',', ' ') . ' FCFA' : '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium text-red-600">
                                            {{ $compte->solde < 0 ? number_format(abs($compte->solde), 0, ',', ' ') . ' FCFA' : '-' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Aucun mouvement comptable enregistré dans la balance.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>