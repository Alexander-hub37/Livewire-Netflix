<div class="container-fluid">

    <div class="flex items-center justify-between mb-4">
        <input wire:model.live.debounce.300ms="search" placeholder="Search" class="input-app">
    </div>
    
    @if ($users->count())
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                        <td>
                            <div class="flex">
                                <button wire:click="edit({{ $user }})">
                                    <x-icons.edit />
                                </button>
                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    {{ $users->links() }}
    @else
        <p class="text-center">No users found</p>
    @endif

    @include('components.modals.user')
</div>
