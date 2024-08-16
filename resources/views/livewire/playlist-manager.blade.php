<div class="container mx-auto p-4">
    
    @include('livewire.message')

    <div class="flex items-center justify-between mb-4">
        <button wire:click="openModal" class="button-primary">
            Create New Playlist
        </button>
        @include('components.modals.playlist')
    </div>

    <div class="mt-8">
        @foreach ($playlists as $playlist)
            <div class="mb-6">
                <div class="flex items-center justify-between border-b  ">
                    <h2 class="text-xl font-semibold mb-4">{{ $playlist->name }}</h2>
                    <button wire:click="deletePlaylist({{ $playlist->id }})" >
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
                <br>
                @if ($playlist->movies->isEmpty())
                    <p>No movies in this playlist</p>
                @else
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($playlist->movies as $movie)
                    <div class="duration-300 hover:scale-105 overflow-hidden rounded-xl relative group">                        
                        <button wire:click="removeFromPlaylist({{ $movie->id }}, {{ $playlist->id }})" class="absolute top-2 right-2 p-2 bg-white rounded-full shadow-md hover:shadow-lg">
                            <svg class="w-4 h-4 text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                        <div class="rounded-xl opacity-0 group-hover:opacity-100 transition duration-300 absolute from-black/80 bg-gradient-to-t inset-x-0 -bottom-2 text-white">
                            <div class="p-4 space-y-3 text-xl group-hover:opacity-100 group-hover:translate-y-0 translate-y-4 pb-10 duration-300 ease-in-out">
                                <div class="font-bold">{{ $movie->title }}</div>
                                <div class="opacity-60 text-sm ">{{ $movie->description }}</div>
                            </div>
                        </div>
                        <img class="h-auto max-w-full rounded-lg" src="{{ $movie->image ? asset('storage/' . $movie->image) : ''}}" alt="{{ $movie->title }}">
                        
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
