<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-900 tracking-tight">
                    {{ __('Catalogue Produits & Stocks') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    Gestion centralisée des articles, des prix et des niveaux de stock.
                </p>
            </div>
            <div>
                <a href="{{ route('produits.create') }}" class="inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-semibold text-white bg-slate-900 hover:bg-slate-800 shadow-sm transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Nouveau Produit
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Message de succès éventuel -->
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
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-400">Référence / Désignation</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-400">Catégorie</th>
                                <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-400">Prix Unit. (FCFA)</th>
                                <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-slate-400">Stock Actuel</th>
                                <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-400">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse($produits ?? [] as $produit)
                                <tr class="hover:bg-slate-50/60 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-slate-900">{{ $produit->libelle ?? $produit->nom }}</div>
                                        <div class="text-xs text-slate-400">REF: {{ $produit->reference ?? 'PRD-'.$produit->id }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700">
                                            {{ optional($produit->categorie)->libelle ?? 'Général' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-semibold text-slate-900">
                                        {{ number_format($produit->prix_vente ?? $produit->prix ?? 0, 0, ',', ' ') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold {{ ($produit->stock_actuel ?? $produit->stock ?? 0) > 0 ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-rose-50 text-rose-700 border border-rose-200' }}">
                                            {{ $produit->stock_actuel ?? $produit->stock ?? 0 }} unités
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                        <a href="{{ route('produits.edit', $produit->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold">Modifier</a>
                                        <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Confirmer la suppression de ce produit ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-rose-500 hover:text-rose-700 font-semibold ml-2">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-400 text-sm">
                                        Aucun produit enregistré dans le catalogue pour le moment.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination si présente -->
                @if(isset($produits) && method_exists($produits, 'links'))
                    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                        {{ $produits->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>