<?php

namespace App\Livewire\Auth;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class Login extends Component
{
    public $email, $password;

    protected $rules = [
        'email' => 'required|string|email|exists:users,email',
        'password' => 'required|string',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            if (Auth::user()->hasVerifiedEmail()) {
                return redirect()->route('browse');
            } else {
                Auth::logout();
                session()->flash('message', 'Please verify your email before logging in.');
                session()->flash('message_type', 'success');
                return;
            }
        }

        session()->flash('message', 'Invalid credentials.');
        session()->flash('message_type', 'error');
    }
    
    public function render()
    {
        return view('livewire.auth.login')->layout('components.layouts.template');
    }
}
