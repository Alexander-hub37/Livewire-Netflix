<x-layouts.template>
    <h5>Verify your email address</h5>
    <div class="container mx-auto">
        <img src="{{ asset('assets/email.png')}}" class="mx-auto" />
    </div>
    <p class="mb-5 text-base text-gray-500 sm:text-sm">Check your email & clic the link to activate
        your account.</p>
    <div class="items-center justify-center flex">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit">
                <a
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300">Resend
                    email</a>
            </button>
        </form>
        @if (Auth::check())
            <a href="{{ route('logout') }}"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-red-700 bg-white rounded-lg">
                Return to site
                @include('components.icons.arrow')
            </a>
        @endif
    </div>
</x-layouts.template>
