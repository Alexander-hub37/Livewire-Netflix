 @if($showModal)
<div class="container-modal">
    <div class="card-modal">

         <div class="flex items-center justify-between p-4 border-b">
            <h3 class="text-lg font-semibold text-gray-900 ">
                {{ $isEditing ? 'Edit Movie' : 'Create Movie' }}
            </h3>
            <button type="button" wire:click="closeModal">
                @include('components.icons.close')
            </button>
        </div>

         <form wire:submit.prevent="{{ $isEditing ? 'update' : 'create' }}" class="p-4">
            <div class="mb-4">
                <label>Title</label>
                <input type="text" wire:model="title" placeholder="Enter movie title" class="input-app @error('title') error @else no-error @enderror">
                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
             </div>
             
             <div wire:ignore class="mb-4">
                <label>Description</label>
                <textarea id="description" wire:model.defer="description" placeholder="Enter movie description" class="input-app @error('title') error @else no-error @enderror"></textarea>
                @error('description')
                    <p class="error">{{ $message }}</p>
                @enderror
             </div>

             <div class="mb-4">
                <label>Upload image</label>
                <input type="file" wire:model="image" class="input-file">
                @error('image') 
                    <p class="error">{{ $message }}</p> 
                @enderror
             </div>

             <div class="mb-4">
                <label>Select Genres</label>
                <div class="flex flex-wrap gap-4">
                    @foreach ( $genres as $genre )
                        <label>
                            <input class="bg-white border-gray-300 rounded focus:ring-blue-500" type="checkbox" wire:model="selectedGenres" value="{{$genre->id}}">
                            {{$genre->name}}
                        </label>
                    @endforeach
                </div>
             </div>
             
             <div class="flex justify-end gap-4">

                <button type="submit" class="button-primary">{{ $isEditing ? 'Update' : 'Create' }}</button>          
                <button type="button" wire:click="closeModal" class="button-secondary">Cancel</button>
            </div>
         </form>
         
     </div>
 </div>
 @endif