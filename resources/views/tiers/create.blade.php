<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un tiers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('tiers.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nom -->
                            <div>
                                <x-input-label for="nom" :value="__('Nom ou Raison sociale')" />
                                <x-text-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required autofocus />
                                <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                            </div>

                            <!-- Type -->
                            <div>
                                <x-input-label for="type" :value="__('Type de tiers')" />
                                <select id="type" name="type" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="client" {{ old('type') == 'client' ? 'selected' : '' }}>Client</option>
                                    <option value="fournisseur" {{ old('type') == 'fournisseur' ? 'selected' : '' }}>Fournisseur</option>
                                </select>
                                <x-input-error :messages="$errors->get('type')" class="mt-2" />
                            </div>

                            <!-- Telephone -->
                            <div>
                                <x-input-label for="telephone" :value="__('Telephone')" />
                                <x-text-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" :value="old('telephone')" />
                                <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                            </div>

                            <!-- Adresse -->
                            <div>
                                <x-input-label for="adresse" :value="__('Adresse')" />
                                <x-text-input id="adresse" class="block mt-1 w-full" type="text" name="adresse" :value="old('adresse')" />
                                <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
                            </div>

                            <!-- Plafond Credit -->
                            <div>
                                <x-input-label for="plafond_credit" :value="__('Plafond de credit (FCFA)')" />
                                <x-text-input id="plafond_credit" class="block mt-1 w-full" type="number" step="0.01" name="plafond_credit" :value="old('plafond_credit', 0)" />
                                <x-input-error :messages="$errors->get('plafond_credit')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('tiers.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Annuler</a>
                            <x-primary-button>
                                {{ __('Enregistrer') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>