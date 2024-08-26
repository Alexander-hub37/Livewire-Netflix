<x-layouts.template>
    {{-- Greeting --}}
    @if (!empty($greeting))
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

</x-layouts.template>
