@if($showModal)
<div class="container-modal">
    <div class="card-modal">
        
        <div class="flex items-center justify-between p-4 border-b">
           <h3 class="text-lg font-semibold text-gray-900 ">
               Create Playlist
           </h3>
           <button type="button" wire:click="closeModal">
                @include('components.icons.close-dark')
           </button>
       </div>

        <form wire:submit.prevent="createPlaylist " class="p-4">
            <div class="mb-4">
                <label>Name</label>
                <input type="text" id="playlistName" wire:model="newPlaylistName" class="input-app @error('newPlaylistName') error @else no-error @enderror" required>
                @error('newPlaylistName') 
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex justify-end gap-4">
               <button type="submit" class="button-primary">Create Playlist</button>          
               <button type="button" wire:click="closeModal" class="button-secondary">Cancel</button>
           </div>
        </form>
    </div>
</div>
@endif