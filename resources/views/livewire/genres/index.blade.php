<div class="container-fluid">
    
    <div class="flex items-center justify-between mb-4">
        <button wire:click="showCreateModal" class="button-primary" >Add New Genre</button>
        @include('components.modals.genre')
        @include('livewire.message')
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($genres as $genre)
            <div class="flex flex-col items-center pb-8 border border-gray-200 rounded-lg">
                <h5>{{ $genre->name }}</h5>
                    <div class="flex mt-4">
                        <button wire:click="edit({{ $genre }})">
                            <x-icons.edit />
                        </button>
                        <button wire:click="delete({{ $genre }})">
                            <x-icons.delete />
                        </button>
                    </div>
            </div>
        @endforeach
    </div>
    <br>
    {{ $genres->links() }}
</div>