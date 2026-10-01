<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-900 tracking-tight">
                    {{ __('Tableau de Bord Exécutif') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    Vue d'ensemble de l'activité, des stocks et de la comptabilité SYSCOHADA.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    <span class="w-2 h-2 mr-2 bg-emerald-500 rounded-full animate-pulse"></span>
                    Système Opérationnel
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- SECTION : Indicateurs Clés de Performance (KPIs) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Carte 1 : Produits -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200/80 hover:shadow-md transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Catalogue Produits</p>
                            <h3 class="text-3xl font-extrabold text-slate-900 mt-2">
                                {{ class_exists(\App\Models\Produit::class) ? \App\Models\Produit::count() : 0 }}
                            </h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-lg group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                            PR
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-xs text-slate-500">
                        <span class="text-blue-600 font-semibold mr-1">Actifs</span> en stock et gestion
                    </div>
                </div>

                <!-- Carte 2 : Tiers -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200/80 hover:shadow-md transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Tiers (Clients / Fournisseurs)</p>
                            <h3 class="text-3xl font-extrabold text-slate-900 mt-2">
                                {{ class_exists(\App\Models\Tiers::class) ? \App\Models\Tiers::count() : 0 }}
                            </h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-lg group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                            TR
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-xs text-slate-500">
                        <span class="text-indigo-600 font-semibold mr-1">Partenaires</span> enregistrés
                    </div>
                </div>

                <!-- Carte 3 : Factures -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200/80 hover:shadow-md transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Factures Émises</p>
                            <h3 class="text-3xl font-extrabold text-slate-900 mt-2">
                                {{ class_exists(\App\Models\Facture::class) ? \App\Models\Facture::count() : 0 }}
                            </h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-lg group-hover:bg-amber-600 group-hover:text-white transition-colors duration-300">
                            FC
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-xs text-slate-500">
                        <span class="text-amber-600 font-semibold mr-1">Ventes</span> et règlements
                    </div>
                </div>

                <!-- Carte 4 : Comptabilité -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200/80 hover:shadow-md transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Écritures Comptables</p>
                            <h3 class="text-3xl font-extrabold text-slate-900 mt-2">
                                {{ class_exists(\App\Models\EcritureComptable::class) ? \App\Models\EcritureComptable::count() : 0 }}
                            </h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center font-bold text-lg group-hover:bg-violet-600 group-hover:text-white transition-colors duration-300">
                            CP
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-xs text-slate-500">
                        <span class="text-violet-600 font-semibold mr-1">SYSCOHADA</span> enregistré
                    </div>
                </div>

            </div>

            <!-- SECTION : Navigation Rapide et Accès Modules -->
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200/80">
                <div class="border-b border-slate-100 pb-4 mb-6">
                    <h3 class="text-lg font-bold text-slate-900">Modules de Gestion Stratégique</h3>
                    <p class="text-sm text-slate-500">Accédez rapidement aux différents espaces de l'application.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    
                    <a href="{{ route('produits.index') }}" class="group p-5 rounded-xl bg-slate-50 border border-slate-200/60 hover:border-blue-500 hover:bg-blue-50/30 transition-all duration-200 flex flex-col justify-between">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-blue-600">Module 01</span>
                            <h4 class="font-bold text-slate-900 text-base mt-1 group-hover:text-blue-700">Produits & Stocks</h4>
                            <p class="text-xs text-slate-500 mt-1">Gestion du catalogue et des mouvements de stock.</p>
                        </div>
                        <div class="mt-4 flex items-center text-xs font-semibold text-blue-600">
                            Accéder au module &rarr;
                        </div>
                    </a>

                    <a href="{{ route('tiers.index') }}" class="group p-5 rounded-xl bg-slate-50 border border-slate-200/60 hover:border-indigo-500 hover:bg-indigo-50/30 transition-all duration-200 flex flex-col justify-between">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-indigo-600">Module 02</span>
                            <h4 class="font-bold text-slate-900 text-base mt-1 group-hover:text-indigo-700">Gestion des Tiers</h4>
                            <p class="text-xs text-slate-500 mt-1">Répertoire unifié clients et fournisseurs.</p>
                        </div>
                        <div class="mt-4 flex items-center text-xs font-semibold text-indigo-600">
                            Accéder au module &rarr;
                        </div>
                    </a>

                    <a href="{{ route('factures.index') }}" class="group p-5 rounded-xl bg-slate-50 border border-slate-200/60 hover:border-amber-500 hover:bg-amber-50/30 transition-all duration-200 flex flex-col justify-between">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-amber-600">Module 03</span>
                            <h4 class="font-bold text-slate-900 text-base mt-1 group-hover:text-amber-700">Facturation Ventes</h4>
                            <p class="text-xs text-slate-500 mt-1">Édition des factures et suivi des règlements.</p>
                        </div>
                        <div class="mt-4 flex items-center text-xs font-semibold text-amber-600">
                            Accéder au module &rarr;
                        </div>
                    </a>

                    <a href="{{ route('comptabilite.journal') }}" class="group p-5 rounded-xl bg-slate-50 border border-slate-200/60 hover:border-violet-500 hover:bg-violet-50/30 transition-all duration-200 flex flex-col justify-between">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-violet-600">Module 04</span>
                            <h4 class="font-bold text-slate-900 text-base mt-1 group-hover:text-violet-700">Comptabilité</h4>
                            <p class="text-xs text-slate-500 mt-1">Journal général et balance des comptes SYSCOHADA.</p>
                        </div>
                        <div class="mt-4 flex items-center text-xs font-semibold text-violet-600">
                            Accéder au module &rarr;
                        </div>
                    </a>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>