<section class="space-y-6">
    <header>
        <h2 class="text-lg font-bold text-slate-900">
            {{ __('Supprimer le compte') }}
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées. Avant de supprimer votre compte, veuillez télécharger toutes les données ou informations que vous souhaitez conserver.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-semibold text-white bg-rose-600 hover:bg-rose-700 shadow-sm transition-all duration-200"
    >{{ __('Supprimer le compte') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8 space-y-6">
            @csrf
            @method('delete')

            <div>
                <h2 class="text-lg font-bold text-slate-900">
                    {{ __('Êtes-vous sûr de vouloir supprimer votre compte ?') }}
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées. Veuillez entrer votre mot de passe pour confirmer la suppression définitive de votre compte.') }}
                </p>
            </div>

            <div>
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="w-full rounded-xl border-slate-300 text-slate-900 shadow-sm focus:border-slate-900 focus:ring-slate-900 text-sm py-2.5"
                    placeholder="{{ __('Mot de passe actuel') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <x-secondary-button x-on:click="$dispatch('close')" class="inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-semibold text-slate-700 bg-white border border-slate-300 hover:bg-slate-50 shadow-sm transition-all duration-200">
                    {{ __('Annuler') }}
                </x-secondary-button>

                <x-danger-button class="inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-semibold text-white bg-rose-600 hover:bg-rose-700 shadow-sm transition-all duration-200">
                    {{ __('Supprimer le compte') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>