<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-900 tracking-tight">
                    {{ __('Gestion des Tiers') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    Répertoire unifié des clients et fournisseurs de l'entreprise.
                </p>
            </div>
            <div>
                <a href="{{ route('tiers.create') }}" class="inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-semibold text-white bg-slate-900 hover:bg-slate-800 shadow-sm transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Nouveau Tiers
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
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-400">Nom / Raison Sociale</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-400">Type</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-400">Téléphone</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-400">Email</th>
                                <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-400">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse($tiers ?? [] as $tier)
                                <tr class="hover:bg-slate-50/60 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-slate-900">{{ $tier->nom ?? $tier->raison_sociale }}</div>
                                        <div class="text-xs text-slate-400">REF: TRS-{{ $tier->id }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700">
                                            {{ $tier->type ?? 'Client / Fournisseur' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                        {{ $tier->telephone ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                        {{ $tier->email ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                        <a href="{{ route('tiers.edit', $tier->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold">Modifier</a>
                                        <form action="{{ route('tiers.destroy', $tier->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Confirmer la suppression de ce tiers ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-rose-500 hover:text-rose-700 font-semibold ml-2">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-400 text-sm">
                                        Aucun tiers enregistré pour le moment.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(isset($tiers) && method_exists($tiers, 'links'))
                    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                        {{ $tiers->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>