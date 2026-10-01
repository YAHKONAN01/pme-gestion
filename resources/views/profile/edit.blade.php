<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-900 tracking-tight">
                    {{ __('Mon Profil & Paramètres') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    Gérez vos informations personnelles, vos identifiants et la sécurité de votre compte.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Informations du profil -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Mot de passe -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Suppression du compte -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden p-8">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>