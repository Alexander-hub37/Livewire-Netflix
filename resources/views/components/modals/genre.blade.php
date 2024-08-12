@if($showModal)
<div class="fixed inset-0 flex items-center justify-center z-50 bg-gray-800 bg-opacity-25">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
        
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
           <h3 class="text-lg font-semibold text-gray-900 ">
               {{ $isEditing ? 'Edit Genre' : 'Create Genre' }}
           </h3>
           <button type="button" wire:click="$set('showModal', false)">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
           </button>
       </div>

        <form wire:submit.prevent="{{ $isEditing ? 'update' : 'create' }}" class="p-4 md:p-5">
            <div class="mb-4">
                <label>Name</label>
                <input type="text" wire:model="name" placeholder="Enter genre name" class="input-app @error('name') error @else no-error @enderror">
                @error('name') 
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex justify-end gap-4">

               <button type="submit" class="button-primary">{{ $isEditing ? 'Update' : 'Create' }}</button>          
               <button type="button" wire:click="$set('showModal', false)" class="button-secondary">Cancel</button>
           </div>
        </form>
    </div>
</div>
@endif