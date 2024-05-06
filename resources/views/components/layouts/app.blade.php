<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: false }"
      x-bind:class="{'dark' : darkMode === true}" x-init="
    if (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        localStorage.setItem('darkMode', JSON.stringify(true));
    }
    darkMode = JSON.parse(localStorage.getItem('darkMode'));
    $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Site Cemeam' }}</title>

        <!-- # Main Style Sheet -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('/front/css/style.css') }}">
        @livewireStyles
        @stack('styles')
    </head>
    <body class="font-sans antialiased">
    <div class="min-h-full bg-gray-100 dark:bg-gray-900">
        <!-- navigation -->
        @livewire('site.components.navigation')
        <!-- /navigation -->

        {{ $slot }}
    </div>
    <!-- footer -->
    @livewire('site.components.footer')
    <!-- /footer -->

    <!-- Main Script -->
    @livewireScripts
    @stack('scripts')
    @livewire('site.components.dark-mode')
    </body>
</html>
