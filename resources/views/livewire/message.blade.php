@if (session()->has('message'))
    @php
        $messageType = session('message_type');
        $alertClasses = [
            'p-2.5',
            'rounded-lg',
            'relative',
            'transition-opacity',
            'duration-500',
            'text-green-800' => $messageType === 'success',
            'bg-green-100' => $messageType === 'success',
            'text-red-800' => $messageType === 'error',
            'bg-red-100' => $messageType === 'error',
            'text-yellow-800' => $messageType === 'warning',
            'bg-yellow-100' => $messageType === 'warning',
        ];
    @endphp
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 3000)" 
        x-show="show" 
        @class($alertClasses)
        x-transition:leave="opacity-0">
        {{ session('message') }}
    </div>
@endif
