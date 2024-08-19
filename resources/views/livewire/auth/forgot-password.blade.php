<div>
    <form wire:submit.prevent="sendResetLink" class="space-y-6">
        <h5>Restablecer contraseña</h5>
        <div>
            <label for="email">Your email</label>
            <input wire:model="email" type="email" id="email" class="input-app @error('email') error @else no-error @enderror" placeholder="Email">
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        @include('livewire.message')

        <button type="submit" class="button-primary w-full">
            Email password reset link
        </button>
    </form>
</div>

