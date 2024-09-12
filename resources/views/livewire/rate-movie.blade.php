<div>
    
    <form wire:submit.prevent="rateMovie">
        <div class="mb-4">
            <label for="rating" class="text-white">Rating</label>
            <select id="rating" wire:model="rating" class="text-white bg-black block w-full mt-1 rounded p-2" required>
                <option value="">Select Rating</option>
                <option value="2">it's not for me</option>
                <option value="7">I like</option>
                <option value="10">I love</option>

            </select>
        </div>
        <button type="submit" class="button-primary">
            Submit Rating
        </button>
    </form>
    <br>
    @include('livewire.message')
</div>
