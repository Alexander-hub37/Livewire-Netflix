@php
    $messageType = session('success') ? 'success' :
                   (session('error') ? 'error' :
                   (session('warning') ? 'warning' : 'info'));

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
        'text-blue-800' => $messageType === 'info',
        'bg-blue-100' => $messageType === 'info',
    ];

    
@endphp

@if (session($messageType))
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 3000)" 
        x-show="show" 
        @class($alertClasses)
        x-transition:leave="opacity-0"
    >
        {{ session($messageType) }}
    </div>
@endif
