@if ($selectedMovie)
    <div class="fixed inset-0 flex items-center justify-center z-50 p-4 ">
        <div class="relative w-3/4 h-5/6 bg-white rounded-lg shadow-lg overflow-hidden">
            <img src="{{ $selectedMovie->image ? asset('storage/' . $selectedMovie->image) : '' }}" alt="{{ $selectedMovie->title }}" class="absolute inset-0 w-full h-full object-cover rounded-lg">
            
            <div class="absolute top-4 right-4 z-10">
                <button type="button" wire:click="closeModal" class="bg-white bg-opacity-75 rounded-full p-2">
                    <svg class="w-5 h-5 text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <div class="absolute z-10 h-full flex flex-col">
                
                <div class="flex flex-col flex-grow justify-end p-6 text-left text-white">
                    <h2 class="text-2xl font-bold mb-4">{{ $selectedMovie->title }}</h2>
                    <p class="text-lg md:text-xl lg:text-2xl">{{ $selectedMovie->description }}</p>
                    
                  
                    <div class="flex space-x-4 mt-4">
                        <button class="px-6 py-3 text-lg font-semibold text-black bg-white rounded-md">Play</button>
                        <button class="px-6 py-3 text-lg font-semibold text-white bg-gray-700 bg-opacity-70 rounded-md">More information</button>
                    </div>
                </div>

                <div class="flex space-x-4 bg-black p-4 ">
                    <div class="w-1/2">
                        <livewire:add-to-playlist :movieId="$selectedMovie->id" />
                    </div>
                    <div class="w-1/2">
                        <livewire:rate-movie :movieId="$selectedMovie->id" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
