<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Adresse Email</label>
            <input id="email" class="w-full rounded-xl border-slate-300 text-slate-900 shadow-sm focus:border-slate-900 focus:ring-slate-900 text-sm py-2.5" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nom@exemple.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Mot de passe</label>
            <input id="password" class="w-full rounded-xl border-slate-300 text-slate-900 shadow-sm focus:border-slate-900 focus:ring-slate-900 text-sm py-2.5"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between text-sm">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-slate-900 shadow-sm focus:ring-slate-900" name="remember">
                <span class="ms-2 text-slate-600">Se souvenir de moi</span>
            </label>

            @if (Route::has('password.request'))
                <a class="font-medium text-slate-600 hover:text-slate-900 underline underline-offset-4" href="{{ route('password.request') }}">
                    Mot de passe oublié ?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="pt-4 border-t border-slate-100">
            <button type="submit" class="w-full justify-center inline-flex items-center px-6 py-3 rounded-xl text-sm font-semibold text-white bg-slate-900 hover:bg-slate-800 shadow-sm transition-all duration-200">
                Se connecter
            </button>
        </div>
    </form>
</x-guest-layout>