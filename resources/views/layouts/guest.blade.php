<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ERP SYSCOHADA') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased bg-slate-50/50">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            
            <!-- Logo & En-tête -->
            <div class="mb-6">
                <a href="/" class="flex flex-col items-center gap-3 group">
                    <img src="{{ asset('images/YK.png') }}" alt="Logo ERP" class="block h-20 w-auto object-contain">
                    
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest"> </span>
                </a>
            </div>

            <!-- Conteneur Principal (Card) qui injectera le formulaire -->
            <div class="w-full sm:max-w-md mt-2 px-8 py-8 bg-white shadow-sm border border-slate-200/80 overflow-hidden sm:rounded-2xl">
                {{ $slot }}
            </div>

        </div>
    </body>
</html>