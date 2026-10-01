<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'accueil') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-slate-900">
        <div class="min-h-screen flex">
            
            <!-- SIDEBAR GAUCHE -->
            <aside class="w-72 bg-slate-900 text-slate-300 flex flex-col h-screen fixed left-0 top-0 z-50 shadow-xl">
                <!-- Logo & Titre -->
                <div class="h-20 flex items-center px-6 gap-3 border-b border-slate-800 shrink-0">
                    <img src="{{ asset('images/YK.png') }}" alt="Logo YK" class="w-10 h-10 object-contain rounded-xl bg-white/5 p-1">
                    <div>
                        <span class="block font-bold text-white text-sm tracking-wide">PME-GESTION</span>
                        <span class="block text-xs text-slate-400">Gestion Intégrée</span>
                    </div>
                </div>

                <!-- Navigation Links -->
                <nav class="flex-1 px-4 py-4 space-y-1.5 overflow-y-auto">
                    <p class="px-5 text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-5">Principal</p>
                    
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : 'hover:bg-slate-800 hover:text-white' }}">
                        <svg class="w-5 h-5 opacity-80 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        <span>TABLEAU DE BORD</span>
                    </a>

                    <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-500 mt-6 mb-2">Modules Métiers</p>

                    <a href="{{ route('produits.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('produits.*') || request()->routeIs('categories.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : 'hover:bg-slate-800 hover:text-white' }}">
                        <svg class="w-5 h-5 opacity-80 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        <span>PRODUITS & STOCKS</span>
                    </a>

                    <a href="{{ route('tiers.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('tiers.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : 'hover:bg-slate-800 hover:text-white' }}">
                        <svg class="w-5 h-5 opacity-80 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <span>TIERS (Clients/Fourn.)</span>
                    </a>

                    <a href="{{ route('mouvements.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('mouvements.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : 'hover:bg-slate-800 hover:text-white' }}">
                        <svg class="w-5 h-5 opacity-80 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                        <span>MOUVEMENTS STOCKS</span>
                    </a>

                    <a href="{{ route('factures.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('factures.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : 'hover:bg-slate-800 hover:text-white' }}">
                        <svg class="w-5 h-5 opacity-80 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <span>FACTURES & VENTES</span>
                    </a>

                    <a href="{{ route('comptabilite.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('comptabilite.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : 'hover:bg-slate-800 hover:text-white' }}">
                        <svg class="w-5 h-5 opacity-80 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>COMPTABILITE</span>
                    </a>
                </nav>

                <!-- Footer Sidebar : Profil & Déconnexion -->
<div class="p-4 border-t border-slate-800 bg-slate-950/60 shrink-0">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3 overflow-hidden">
            @if(Auth::user() && Auth::user()->avatar)
                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" class="w-9 h-9 rounded-full object-cover border border-slate-700 shrink-0">
            @else
                <div class="w-9 h-9 rounded-full bg-slate-800 flex items-center justify-center text-white font-bold text-xs uppercase shrink-0">
                    {{ substr(Auth::user()->name ?? 'U', 0, 2) }}
                </div>
            @endif
            <div class="truncate">
                <p class="text-xs font-bold text-white truncate">{{ Auth::user()->name ?? 'Utilisateur' }}</p>
                <a href="{{ route('profile.edit') }}" class="text-[11px] text-slate-400 hover:text-white underline">Mon profil</a>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="p-2 text-slate-400 hover:text-rose-400 transition-colors shrink-0" title="Se déconnecter">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            </button>
        </form>
    </div>
</div>
            </aside>

            <!-- CONTENU PRINCIPAL AVEC IMAGE DE FOND -->
            <div class="flex-1 ml-72 flex flex-col min-h-screen bg-cover bg-center bg-fixed relative" style="background-image: url('{{ asset('images/fond.jpg') }}');">
                
                <!-- VOILE SEMI-TRANSPARENT (Permet de garder les textes et cartes lisibles par-dessus l'image) -->
                <div class="absolute inset-0 bg-slate-100/92 backdrop-blur-[2px]"></div>

                <!-- CONTENU WRAPPER (Placé au-dessus du voile avec relative z-10) -->
                <div class="relative z-10 flex flex-col flex-1">
                    
                    <!-- HEADER SUPERIEUR -->
                    <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-200/80 px-8 flex items-center justify-between sticky top-0 z-40 shadow-xs">
                        <div>
                            @isset($header)
                                {{ $header }}
                            @else
                                <h1 class="text-xl font-extrabold text-slate-900 tracking-tight">ERP SYSCOHADA</h1>
                            @endif
                        </div>
                    </header>

                    <!-- CORPS DE LA PAGE -->
                    <main class="flex-1 p-8">
                        {{ $slot }}
                    </main>

                </div>

            </div>

        </div>
    </body>
</html>