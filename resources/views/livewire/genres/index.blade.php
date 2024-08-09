<div>
    <h1>Genres</h1>

    <div>
        <form wire:submit.prevent="{{ $isEditing ? 'update' : 'create' }}">
            <input type="text" wire:model="name" placeholder="Enter genre name">
            @error('name') <span>{{ $message }}</span> @enderror
            <button type="submit">{{ $isEditing ? 'Update' : 'Create' }}</button>
            @if ($isEditing)
                <button type="button" wire:click="resetForm">Cancel</button>
            @endif
        </form>
    </div>

    <div>
        <h2>Existing Genres</h2>
        <ul>
            @foreach($genres as $genre)
                <li>
                    {{ $genre->name }}
                    <button wire:click="edit({{ $genre->id }})">Edit</button>
                    <button wire:click="delete({{ $genre->id }})">Delete</button>
                </li>
            @endforeach
        </ul>
    </div>
</div>
