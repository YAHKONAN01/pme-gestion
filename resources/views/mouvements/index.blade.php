<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-900 tracking-tight">
                    {{ __('Mouvements de Stock') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    Traçabilité des entrées, sorties et ajustements de marchandises.
                </p>
            </div>
            <div>
                <a href="{{ route('mouvements.create') }}" class="inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-semibold text-white bg-slate-900 hover:bg-slate-800 shadow-sm transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Nouveau Mouvement
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

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-100">
                        <thead class="bg-slate-50/75">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-400">Date / Référence</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-400">Produit concerné</th>
                                <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-slate-400">Type de Mouvement</th>
                                <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-slate-400">Quantité</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-400">Motif / Commentaire</th>
                                <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-400">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse($mouvements ?? [] as $mouvement)
                                <tr class="hover:bg-slate-50/60 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-slate-900">{{ optional($mouvement->created_at)->format('d/m/Y H:i') ?? ($mouvement->date_mouvement ?? '-') }}</div>
                                        <div class="text-xs text-slate-400">MVT-{{ $mouvement->id }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-slate-800">
                                        {{ optional($mouvement->produit)->libelle ?? optional($mouvement->produit)->nom ?? 'Article #'.$mouvement->produit_id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @php
                                            $type = strtolower($mouvement->type ?? $mouvement->sens ?? '');
                                            $isEntree = in_array($type, ['entree', 'in', 'approvisionnement']);
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold {{ $isEntree ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-rose-50 text-rose-700 border border-rose-200' }}">
                                            {{ ucfirst($mouvement->type ?? $mouvement->sens ?? 'Mouvement') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-extrabold text-slate-900">
                                        {{ ($isEntree ? '+' : '-') . ($mouvement->quantite ?? 0) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 max-w-xs truncate">
                                        {{ $mouvement->motif ?? $mouvement->commentaire ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <form action="{{ route('mouvements.destroy', $mouvement->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Confirmer la suppression de ce mouvement ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-rose-500 hover:text-rose-700 font-semibold">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-slate-400 text-sm">
                                        Aucun mouvement de stock enregistré pour le moment.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(isset($mouvements) && method_exists($mouvements, 'links'))
                    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                        {{ $mouvements->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>