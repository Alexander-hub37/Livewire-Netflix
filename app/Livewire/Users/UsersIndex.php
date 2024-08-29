<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class UsersIndex extends Component
{
    use WithPagination;

    public $name;
    public $email;
    public $search;
    public $user;
    public $isEditing = false;
    public $showModal = false;
    public $selectedRoles = [];

    protected $rules = [
        'selectedRoles' => 'required|array'
    ];
    
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function edit(User $user)
    {
        $this->resetForm();
        $this->isEditing = true;
        $this->user = $user;
        $this->name= $user->name;
        $this->email = $user->email;
        $this->selectedRoles = $user->roles->pluck('id')->toArray();
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();
        $user = $this->user;
        $user->roles()->sync($this->selectedRoles);
        $this->user->save();
        $this->resetForm();
        $this->showModal = false;
    }

    public function create()
    {
        $this->resetForm();
        $this->isEditing = false;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->resetForm();
        $this->showModal = false;
    }

    public function resetForm()
    {
        $this->user = null;
        $this->selectedRoles = [];
        $this->isEditing = false;
        $this->showModal = false;
    }

    

    public function render()
    {
        $roles = Role::all();
        $users = User::where('name', 'like', '%'.$this->search.'%')
            ->orWhere('email', 'like', '%'.$this->search.'%')->with('roles')->paginate(10);
        return view('livewire.users.users-index', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }
}
