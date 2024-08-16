@if (session()->has('message'))
    <div class="p-4 mb-4 text-green-800 bg-green-100 rounded-lg" role="alert">
        {{ session('message') }}
    </div>
@endif

@if (session()->has('error'))
    <div class="p-4 mb-4 text-red-800 bg-red-100 rounded-lg" role="alert">
        {{ session('error') }}
    </div>
@endif