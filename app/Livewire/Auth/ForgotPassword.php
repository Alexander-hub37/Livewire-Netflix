<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Password;


class ForgotPassword extends Component
{
    public $email;

    protected $rules = [
        'email' => 'required|email',
    ];

    public function sendResetLink()
    {
        $this->validate();

        $status = Password::sendResetLink(
            ['email' => $this->email]
        );

        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('success', __($status));
            
        } else {
            session()->flash('error', __($status));
           
        }
    }
    
    public function render()
    {
        return view('livewire.auth.forgot-password')->layout('components.layouts.template');
    }
}
