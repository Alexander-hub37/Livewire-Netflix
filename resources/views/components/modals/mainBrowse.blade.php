@if ($selectedMovie)
    <div class="fixed inset-0 flex items-center justify-center z-50 p-4 bg-gray-600 bg-opacity-5">
        <div class="relative w-3/4 h-5/6 bg-white rounded-lg shadow-lg overflow-hidden">
            <img src="{{ $selectedMovie->image ? asset('storage/' . $selectedMovie->image) : '' }}" alt="{{ $selectedMovie->title }}" class="absolute w-full h-full object-cover rounded-lg">
            
            <div class="absolute top-4 right-4 z-20 duration-300 hover:scale-110">
                <button type="button" wire:click="closeModal" class="bg-white bg-opacity-75 rounded-full p-2">
                    @include('components.icons.close-dark')
                </button>
            </div>

            <div class="absolute z-10 h-full flex flex-col">
                
                <div class="flex flex-col flex-grow justify-end p-6 text-left text-white">
                    <h2 class="text-2xl font-bold mb-4">{{ $selectedMovie->title }}</h2>
                    <p class="text-lg md:text-xl lg:text-2xl">{{ $selectedMovie->description }}</p>
                    
                  
                    <div class="flex space-x-4 mt-4">
                        <button class="px-3 py-1.5 md:px-6 md:py-3 text-sm md:text-lg font-semibold text-black bg-white rounded-md">Play</button>
                        <button class="px-3 py-1.5 md:px-6 md:py-3 text-sm md:text-lg font-semibold bg-gray-700 bg-opacity-70 rounded-md">More information</button>
                    </div>
                </div>
                <div class="flex flex-wrap md:flex-nowrap bg-black">
                
                    <div class="w-full md:w-1/2 order-1 md:order-1 p-4">
                        <livewire:add-to-playlist :movieId="$selectedMovie->id" />
                    </div>
                    <div class="w-full md:w-1/2 order-2 md:order-2 p-4">
                        <livewire:rate-movie :movieId="$selectedMovie->id" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
