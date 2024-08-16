<div class="card-app">
    <form wire:submit.prevent="register" class="space-y-6">
        <h5> Sign up to our platform </h5>
        <div>
            <label>Your name</label>
            <input type="text" wire:model="name" placeholder="Name" class="input-app @error('name') error @else no-error @enderror">
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label>Your email</label>
            <input type="email" wire:model="email" placeholder="Email" class="input-app @error('email') error @else no-error @enderror">
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label>Your password</label>
            <input type="password" wire:model="password" placeholder="Password" class="input-app @error('password') error @else no-error @enderror">
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label>Confirm password</label>
            <input type="password" wire:model="password_confirmation" placeholder="Confirm Password" class="input-app @error('password_confirmation') error @else no-error @enderror">
            @error('password_confirmation')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="button-primary w-full">Register</button>

        <div class="text-sm font-medium text-gray-500">
            Are you already registered? <a href="{{ route('login') }}" class="text-red-700 hover:underline">Sign in</a>
        </div> 

    </form>
</div>
