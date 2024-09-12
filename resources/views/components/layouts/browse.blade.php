<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Netflix' }}</title>
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="bg-neutral-900 text-white">
        <x-layouts.navbar />
            {{ $slot }}
            @livewireScripts
    </body>
</html>
