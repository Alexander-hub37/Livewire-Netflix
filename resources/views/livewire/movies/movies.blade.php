<div class="container-fluid">

    <div class="flex items-center justify-between mb-4">
        <button wire:click="showCreateModal" class="button-primary">Add New Movie</button>
        @include('components.modals.movie')
        @include('livewire.message')
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Genres</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movies as $movie)
                    <tr>
                        <td><img class="w-32" src="{{ $movie->image ? asset('storage/' . $movie->image) : '' }}"
                                alt="{{ $movie->title }}"></td>
                        <td>{{ $movie->title }}</td>
                        <td>{!! $movie->description !!}</td>
                        <td>{{ $movie->genres->pluck('name')->join(', ') }}</td>
                        <td>
                            <div class="flex">
                                <button wire:click="edit({{ $movie }})">
                                    <x-icons.edit />
                                </button>
                                <button wire:click="delete({{ $movie }})">
                                    <x-icons.delete />
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    {{ $movies->links() }}
</div>
