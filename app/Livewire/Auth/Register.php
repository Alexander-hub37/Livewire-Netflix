<?php

namespace App\Livewire\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Spatie\Permission\Traits\HasRoles;

use Livewire\Component;

class Register extends Component
{
    public $name, $email, $password, $password_confirmation;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|confirmed|min:8',
    ];

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $user->assignRole('User');

        event(new Registered($user));
        Auth::login($user);

        session()->flash('success', 'Registration successful! Please check your email for verification.');

        return redirect()->route('browse');
    }

    public function render()
    {
        return view('livewire.auth.register')->layout('components.layouts.template');
    }
}
