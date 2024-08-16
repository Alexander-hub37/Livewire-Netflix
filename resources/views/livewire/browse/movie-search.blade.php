<div class="container mx-auto p-4">
  
  <div class="flex items-center justify-between mb-4">
    <input
      wire:model.live.debounce.300ms="search"
      type="text"
      placeholder="Search movies..."
      class="p-2 border rounded w-40 md:w-64 bg-black text-white placeholder-white focus:ring-2 focus:ring-red-500 focus:border-red-500"
    />
  </div>
    
  <div class="mt-8">
      <section class="mb-12 ">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 ">
            @forelse($movies as $movie)
            <div class="duration-300 hover:scale-105 overflow-hidden rounded-xl relative group">                        
              <div class="rounded-xl opacity-0 group-hover:opacity-100 transition duration-300 absolute from-black/80 bg-gradient-to-t inset-x-0 -bottom-2 text-white">
                  <div class="p-4 space-y-3 text-xl group-hover:opacity-100 group-hover:translate-y-0 translate-y-4 pb-10 duration-300 ease-in-out">
                      <div class="font-bold">{{ $movie->title }}</div>
                      <div class="opacity-60 text-sm ">{{ $movie->description }}</div>
                  </div>
              </div>
                <img class="h-auto max-w-full rounded-lg " src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}">              
          </div>
            @empty
                <P>No movies found.</P>
            @endforelse
        </div>   
      </section>   
  </div>
  
</div>
