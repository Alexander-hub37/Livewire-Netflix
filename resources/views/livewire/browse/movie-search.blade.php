<div class="container-fluid">

  <div class="flex items-center justify-between mb-4">
      <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search movies..."
          class="rounded-lg w-40 md:w-64 bg-black text-white placeholder-white focus:ring-2 focus:ring-red-500 focus:border-red-500" />
  </div>

  <div class="mt-8">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 ">
        @forelse($movies as $movie)
            <div class="container-image group">
              <div class="container-info group-hover:opacity-100">
                <div class="p-4 space-y-2 pb-6">
                    <div class="font-bold text-sm md:text-xl">{{ $movie->title }}</div>
                    <div class="opacity-60 text-sm ">{!! $movie->description !!}</div>
                  </div>
              </div>
              <img class="max-w-full rounded-lg " src="{{ asset('storage/' . $movie->image) }}"
                  alt="{{ $movie->title }}">
            </div>
        @empty
            <P>No movies found.</P>
        @endforelse
    </div>
  </div>

</div>
