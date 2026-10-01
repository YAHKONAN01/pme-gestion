<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-900 tracking-tight">
                    {{ __('Comptabilité Générale - SYSCOHADA') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    Journal des écritures, grand livre et suivi des comptes de l'exercice.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('comptabilite.create') ?? '#' }}" class="inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-semibold text-white bg-slate-900 hover:bg-slate-800 shadow-sm transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Nouvelle Écriture
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Table des Écritures Comptables -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-500">Journal Général des Opérations</h3>
                    <span class="text-xs text-slate-400 font-medium">Norme SYSCOHADA</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-100">
                        <thead class="bg-slate-50/75">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-400">Date / Pièce</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-400">N° Compte</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-400">Libellé de l'écriture</th>
                                <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-400">Débit (FCFA)</th>
                                <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-400">Crédit (FCFA)</th>
                                <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-400">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse($ecritures ?? [] as $ecriture)
                                <tr class="hover:bg-slate-50/60 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-slate-900">{{ optional($ecriture->created_at)->format('d/m/Y') ?? ($ecriture->date_ecriture ?? '-') }}</div>
                                        <div class="text-xs text-slate-400">PC: {{ $ecriture->piece_ref ?? 'REF-'.$ecriture->id }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-blue-600">
                                        {{ optional($ecriture->compte)->numero_compte ?? $ecriture->numero_compte ?? '401' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700 font-medium">
                                        {{ $ecriture->libelle ?? $ecriture->description ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-semibold text-slate-900">
                                        {{ ($ecriture->sens ?? '') == 'debit' || ($ecriture->montant_debit ?? 0) > 0 ? number_format($ecriture->montant_debit ?? $ecriture->montant ?? 0, 0, ',', ' ') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-semibold text-slate-900">
                                        {{ ($ecriture->sens ?? '') == 'credit' || ($ecriture->montant_credit ?? 0) > 0 ? number_format($ecriture->montant_credit ?? $ecriture->montant ?? 0, 0, ',', ' ') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <form action="{{ route('comptabilite.destroy', $ecriture->id) ?? '#' }}" method="POST" class="inline-block" onsubmit="return confirm('Confirmer la suppression de cette écriture comptable ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-rose-500 hover:text-rose-700 font-semibold">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-slate-400 text-sm">
                                        Aucune écriture comptable enregistrée pour le moment.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(isset($ecritures) && method_exists($ecritures, 'links'))
                    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                        {{ $ecritures->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>