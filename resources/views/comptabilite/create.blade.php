<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-900 tracking-tight">
                    {{ __('Nouvelle Écriture Comptable') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    Saisie d'une opération au journal général SYSCOHADA.
                </p>
            </div>
            <div>
                <a href="{{ route('comptabilite.journal') }}" class="inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-semibold text-slate-700 bg-white border border-slate-300 hover:bg-slate-50 shadow-sm transition-all duration-200">
                    &larr; Retour au Journal
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Gestion des erreurs de validation -->
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm">
                    <p class="font-bold mb-1">Veuillez corriger les erreurs ci-dessous :</p>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden p-8">
                <form action="{{ route('comptabilite.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Date de l'écriture -->
                        <div>
                            <label for="date_ecriture" class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Date de l'opération</label>
                            <input type="date" name="date_ecriture" id="date_ecriture" value="{{ old('date_ecriture', date('Y-m-d')) }}" required
                                class="w-full rounded-xl border-slate-300 text-slate-900 shadow-sm focus:border-slate-900 focus:ring-slate-900 text-sm py-2.5">
                        </div>

                        <!-- Référence de la pièce -->
                        <div>
                            <label for="piece_ref" class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Référence Pièce Justificative</label>
                            <input type="text" name="piece_ref" id="piece_ref" value="{{ old('piece_ref') }}" placeholder="Ex: FAC-2026-001" required
                                class="w-full rounded-xl border-slate-300 text-slate-900 shadow-sm focus:border-slate-900 focus:ring-slate-900 text-sm py-2.5">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Code Journal SYSCOHADA -->
                        <div>
                            <label for="journal_code" class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Code Journal</label>
                            <select name="journal_code" id="journal_code" required
                                class="w-full rounded-xl border-slate-300 text-slate-900 shadow-sm focus:border-slate-900 focus:ring-slate-900 text-sm py-2.5">
                                <option value="OD" {{ old('journal_code') == 'OD' ? 'selected' : '' }}>OD - Opérations Diverses</option>
                                <option value="VE" {{ old('journal_code') == 'VE' ? 'selected' : '' }}>VE - Journal des Ventes</option>
                                <option value="AC" {{ old('journal_code') == 'AC' ? 'selected' : '' }}>AC - Journal des Achats</option>
                                <option value="BQ" {{ old('journal_code') == 'BQ' ? 'selected' : '' }}>BQ - Journal de Banque</option>
                                <option value="CA" {{ old('journal_code') == 'CA' ? 'selected' : '' }}>CA - Journal de Caisse</option>
                            </select>
                        </div>

                        <!-- Numéro de Compte SYSCOHADA -->
                        <div>
                            <label for="numero_compte" class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">N° Compte (SYSCOHADA)</label>
                            <input type="text" name="numero_compte" id="numero_compte" value="{{ old('numero_compte') }}" placeholder="Ex: 411000 ou 701000" required
                                class="w-full rounded-xl border-slate-300 text-slate-900 shadow-sm focus:border-slate-900 focus:ring-slate-900 text-sm py-2.5">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-1 gap-6">
                        <!-- Libellé -->
                        <div>
                            <label for="libelle" class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Libellé de l'écriture</label>
                            <input type="text" name="libelle" id="libelle" value="{{ old('libelle') }}" placeholder="Ex: Vente de marchandises au comptant" required
                                class="w-full rounded-xl border-slate-300 text-slate-900 shadow-sm focus:border-slate-900 focus:ring-slate-900 text-sm py-2.5">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4 border-t border-slate-100">
                        <!-- Montant Débit -->
                        <div>
                            <label for="montant_debit" class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Montant Débit (FCFA)</label>
                            <input type="number" step="any" name="montant_debit" id="montant_debit" value="{{ old('montant_debit', 0) }}"
                                class="w-full rounded-xl border-slate-300 text-slate-900 shadow-sm focus:border-slate-900 focus:ring-slate-900 text-sm py-2.5">
                        </div>

                        <!-- Montant Crédit -->
                        <div>
                            <label for="montant_credit" class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Montant Crédit (FCFA)</label>
                            <input type="number" step="any" name="montant_credit" id="montant_credit" value="{{ old('montant_credit', 0) }}"
                                class="w-full rounded-xl border-slate-300 text-slate-900 shadow-sm focus:border-slate-900 focus:ring-slate-900 text-sm py-2.5">
                        </div>
                    </div>

                    <!-- Bouton de soumission -->
                    <div class="flex justify-end pt-6 border-t border-slate-100">
                        <button type="submit" class="inline-flex items-center px-6 py-3 rounded-xl text-sm font-semibold text-white bg-slate-900 hover:bg-slate-800 shadow-sm transition-all duration-200">
                            Enregistrer l'écriture
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>