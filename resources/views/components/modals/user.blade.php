@if($showModal)
<div class="container-modal">
    <div class="card-modal">

         <div class="flex items-center justify-between p-4 border-b">
            <h3 class="text-lg font-semibold text-gray-900 ">
                Assign Rol
            </h3>
            <button type="button" wire:click="closeModal">
                @include('components.icons.close')
            </button>
        </div>

         <form wire:submit="update" class="p-4">
            <div class="mb-4">
                <label>Name</label>
                <input type="text" wire:model="name" class="input-app no-error" readonly>
             </div>

             <div class="mb-4">
                <label>Email</label>
                <input type="text" wire:model="email" class="input-app no-error" readonly>
             </div>

             <div class="mb-4">
                <label>Select Roles</label>
                <div class="flex flex-wrap gap-4">
                    @foreach ( $roles as $role )
                        <label>
                            <input class="bg-white border-gray-300 rounded focus:ring-blue-500" type="checkbox" wire:model="selectedRoles" value="{{$role->id}}">
                            {{$role->name}}
                        </label>
                    @endforeach
                </div>
             </div>
             
             <div class="flex justify-end gap-4">
                <button type="submit" class="button-primary">Update</button>          
                <button type="button" wire:click="closeModal" class="button-secondary">Cancel</button>
            </div>
         </form>
         
     </div>
 </div>
 @endif