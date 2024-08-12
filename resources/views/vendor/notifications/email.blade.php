<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    @vite(['resources/css/app.css', 'resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-gray-200 font-sans">
    
    <div class="flex items-center justify-center min-h-screen py-6 px-4" style="background-image: url('https://assets.nflxext.com/ffe/siteui/vlv3/826348c2-cdcb-42a0-bc11-a788478ba5a2/56eb4a2f-2136-4e15-9960-84d26f3bed98/PE-es-20240729-POP_SIGNUP_TWO_WEEKS-perspective_WEB_bb462c08-8ad2-4990-a192-8b2d3b4d1e01_large.jpg'); background-size: cover; background-position: center;">
        
        <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-6">
            {{-- Greeting --}}
            @if (! empty($greeting))
                <h1 class="text-2xl font-semibold mb-4">{{ $greeting }}</h1>
            @else
                @if ($level === 'error')
                    <h1 class="text-2xl font-semibold mb-4">@lang('Whoops!')</h1>
                @else
                    <h1 class="text-2xl font-semibold mb-4">@lang('Welcome to Netflix!')</h1>
                @endif
            @endif

            {{-- Intro Lines --}}
            @foreach ($introLines as $line)
                <p class="text-gray-700 mb-4">{{ $line }}</p>
            @endforeach

            {{-- Action Button --}}
            @isset($actionText)
                <div class="text-center mb-4">
                    <a href="{{ $actionUrl }}" class="bg-red-700 py-2 px-4 rounded hover:bg-red-800" style="color: #FFFFFF;">
                        {{ $actionText }}
                    </a>
                </div>
            @endisset

            {{-- Outro Lines --}}
            @foreach ($outroLines as $line)
                <p class="text-gray-700 mt-4">{{ $line }}</p>
            @endforeach

        </div>
    </div>
</body>
</html>
