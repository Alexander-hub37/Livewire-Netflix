@if (session()->has('message'))
    <div class="p-2.5 text-green-800 bg-green-100 rounded-lg">
        {{ session('message') }}
    </div>
@endif

@if (session()->has('error'))
    <div class="p-2.5 text-red-800 bg-red-100 rounded-lg">
        {{ session('error') }}
    </div>
@endif