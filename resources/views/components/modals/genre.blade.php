@if($showModal)
<div class="container-modal">
    <div class="card-modal">
        
        <div class="flex items-center justify-between p-4 border-b">
           <h5 class="text-lg font-semibold text-gray-900 ">
               {{ $isEditing ? 'Edit Genre' : 'Create Genre' }}
           </h5>
           <button type="button" wire:click="closeModal">
                @include('components.icons.close')
           </button>
        </div>

        <form wire:submit.prevent="{{ $isEditing ? 'update' : 'create' }}" class="p-4">
            <div class="mb-4">
                <label>Name</label>
                <input type="text" wire:model="form.name" placeholder="Enter genre name" class="input-app @error('form.name') error @else no-error @enderror">
                @error('form.name') 
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex justify-end gap-4">
               <button type="submit" class="button-primary">{{ $isEditing ? 'Update' : 'Create' }}</button>          
               <button type="button" wire:click="closeModal" class="button-secondary">Cancel</button>
           </div>
        </form>
        
    </div>
</div>
@endif