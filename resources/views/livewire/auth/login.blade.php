
    <form wire:submit.prevent="login" class="space-y-6">
        <h5> Sign in to our platform </h5>
        <div>
            <label>Your email</label>
            <input type="email" wire:model="email" class="input-app @error('email') error @else no-error @enderror"
                placeholder="Email">
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label>Your password</label>
            <input type="password" wire:model="password"
                class="input-app @error('password') error @else no-error @enderror" placeholder="Password">
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex justify-end">
            <a href="{{ route('password.request') }}" class="text-sm font-medium text-red-700 hover:underline">Forgot
                your password?</a>
        </div>

        @include('livewire.message')

        <button type="submit" class="button-primary w-full">Login</button>

        <div class="text-sm font-medium text-gray-500">
            Not registered? <a href="{{ route('register') }}" class="text-red-700 hover:underline">Create account</a>
        </div>
    </form>

