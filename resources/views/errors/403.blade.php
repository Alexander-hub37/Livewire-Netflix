<x-layouts.browse>
    <div class="relative w-full h-screen">

        <div class="bg-main page-403"></div>

        <div class="absolute inset-0 bg-black bg-opacity-10"></div>

        <div class="relative flex items-center justify-center h-full z-10">
            <div class="text-center p-6 bg-inherit rounded-lg shadow-lg">
                <h1 class="text-6xl font-bold text-white">Lost your way?</h1>
                <p class="mt-4 text-2xl text-white py-6">
                    Sorry, we can´t find that page. You'll find lots to explore on<br>
                    the home page.
                </p>
                <a href="{{ route('browse') }}"
                    class="mt-4 inline-block px-6 py-3 font-bold text-lg bg-white text-black rounded-lg hover:bg-gray-200 hover:opacity-75">Netflix Home</a>
                <p class="mt-4 text-3xl text-white pt-6 font-mono">
                    Error code <span class="font-extrabold">NSES-403</span>
                </p>
            </div>
        </div>
    </div>
</x-layouts.browse>
