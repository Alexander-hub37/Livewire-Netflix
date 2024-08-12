<div class="card-app">
    <form wire:submit.prevent="login" class="space-y-6">
        <h5> Sign in to our platform </h5>
        <div>
            <label for="email">Your email</label>
            <input type="email" wire:model="email" class="input-app @error('email') error @else no-error @enderror" placeholder="Email">
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="password">Your password</label>
            <input type="password" wire:model="password" class="input-app @error('password') error @else no-error @enderror" placeholder="Password">
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="button-primary w-full">Login</button>

        <div class="text-sm font-medium text-gray-500">
            Not registered? <a href="{{ route('register') }}" class="text-red-700 hover:underline">Create account</a>
        </div> 
    </form>
</div>

