<div class="container-fluid">

    <div class="flex items-center justify-between mb-4">
        <button wire:click="openModal" class="button-primary">
            Create New Playlist
        </button>
        @include('components.modals.playlist')
        @include('livewire.message')
    </div>

    <div class="mt-8">
        @foreach ($playlists as $playlist)
            <div class="mb-6">
                <div class="flex items-center justify-between border-b">
                    <h2 class="text-xl font-semibold mb-3">{{ $playlist->name }}</h2>
                    <button wire:click="deletePlaylist({{ $playlist->id }})" >
                        @include('components.icons.close')
                    </button>
                </div>
                @if ($playlist->movies->isEmpty())
                    <p class="mt-3">No movies in this playlist</p>
                @else
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-3">
                    @foreach($playlist->movies as $movie)
                    <div class="container-image group">                        
                        <button wire:click="removeFromPlaylist({{ $movie->id }}, {{ $playlist->id }})" class="absolute top-2 right-2 p-2 bg-white rounded-full">
                            @include('components.icons.close-dark')
                        </button>
                        <div class="container-info group-hover:opacity-100">
                            <div class="p-4 space-y-2 pb-6">
                                <div class="font-bold text-sm md:text-xl">{{ $movie->title }}</div>
                                <div class="opacity-60 text-sm ">{{ $movie->description }}</div>
                            </div>
                        </div>
                        <img class="max-w-full rounded-lg" src="{{ $movie->image ? asset('storage/' . $movie->image) : ''}}" alt="{{ $movie->title }}">
                        
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
