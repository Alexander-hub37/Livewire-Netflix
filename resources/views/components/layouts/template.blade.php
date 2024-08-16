<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Netflix' }}</title>
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        <div class="flex items-center justify-center min-h-screen py-6 px-4" style="background-image: url('https://assets.nflxext.com/ffe/siteui/vlv3/826348c2-cdcb-42a0-bc11-a788478ba5a2/56eb4a2f-2136-4e15-9960-84d26f3bed98/PE-es-20240729-POP_SIGNUP_TWO_WEEKS-perspective_WEB_bb462c08-8ad2-4990-a192-8b2d3b4d1e01_large.jpg'); background-size: cover; background-position: center;">
            <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-6">
                    
            {{ $slot }}
            
            </div>
        </div>
    </body>
</html>
