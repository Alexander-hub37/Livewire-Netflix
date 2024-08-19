<div>
    <form wire:submit.prevent="resetPassword" class="space-y-6">
        <input type="hidden" wire:model="token">
        <h5>Restablecer contraseña</h5>
        <div>
            <label for="email">Correo electrónico</label>
            <input wire:model="email" type="email" id="email" class="input-app @error('email') error @else no-error @enderror" readonly>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="password">Nueva contraseña</label>
            <input wire:model="password" type="password" id="password" placeholder="Password" class="input-app @error('password') error @else no-error @enderror">
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="password_confirmation">Confirmar contraseña</label>
            <input wire:model="password_confirmation" type="password" id="password_confirmation" placeholder="Confirm Password" class="input-app @error('password_confirmation') error @else no-error @enderror">
            @error('password_confirmation')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        @include('livewire.message')

        <button type="submit" class="button-primary w-full">
            Reset password
        </button>
    </form>
</div>
