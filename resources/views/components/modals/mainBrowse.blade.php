@if ($selectedMovie)
    <div class="fixed inset-0 flex items-center justify-center z-50 p-4 bg-gray-600 bg-opacity-5">
        <div class="relative w-full max-w-4xl max-h-full">

            <div class="relative bg-neutral-900 rounded-lg shadow">

                <div class="relative">
                    <img class="w-full h-110 object-cover rounded-t-lg"
                        src="{{ $selectedMovie->image ? asset('storage/' . $selectedMovie->image) : '' }}"
                        alt="{{ $selectedMovie->title }}">

                    <div
                        class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-neutral-900 to-transparent rounded-t-lg">
                    </div>

                    <div class="absolute top-4 right-4 z-20 duration-300 hover:scale-110">
                        <button type="button" wire:click="closeModal" class="bg-neutral-900 rounded-full p-2">
                            <x-icons.close />
                        </button>
                    </div>
                </div>

                <div class="px-6 py-4">
                    <div class="flex space-x-4 items-center justify-between flex-col md:flex-row">
                        <div>
                            <h3 class="mb-4 text-2xl font-bold text-white">{{ $selectedMovie->title }}</h3>
                            <div class="flex space-x-4 items-center">
                                <span class="text-sm text-gray-300">2013</span>
                                <span class="text-sm text-gray-300">76 episodios</span>
                                <span class="text-sm text-gray-300">13+</span>
                            </div>
                            <p class="mt-4 text-gray-200">{!! $selectedMovie->description !!}</p>
                            <div class="mt-6">
                                <button class="px-6 py-2 text-black bg-white rounded-md mr-2">
                                    Play
                                </button>
                            </div>
                        </div>
                
                        <div class="mt-6 md:mt-0 flex space-x-4">
                            <livewire:add-to-playlist :movieId="$selectedMovie->id" />
                            <livewire:rate-movie :movieId="$selectedMovie->id" />
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endif
