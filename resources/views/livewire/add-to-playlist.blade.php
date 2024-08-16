<div>
    @include('livewire.message')
    
    <form wire:submit.prevent="addToPlaylist">
        <div class="mb-4">
            <label for="playlist" class="text-white">Select Playlist</label>
            <select id="playlist" wire:model="selectedPlaylist" class="text-white bg-black block w-full mt-1 rounded p-2">
                <option value="">Select Playlist</option>
                @foreach($playlists as $playlist)
                    <option value="{{ $playlist->id }}">{{ $playlist->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="button-primary">
            Add to Playlist
        </button>
    </form>
</div>
