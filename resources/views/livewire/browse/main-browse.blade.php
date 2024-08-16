<div>
  @if ($latestMovie)
  <div class="relative h-[555px] w-full"> 
      <div class="absolute inset-0 bg-cover bg-center lg:bg-[url('https://i.blogs.es/2a9439/avengers_endgame_analisis_problema_marvel/1366_2000.jpeg')] bg-[url('https://imageio.forbes.com/blogs-images/markhughes/files/2019/04/AVENGERS-ENDGAME-poster-DOLBY-CINEMA.jpg?height=1039&width=711&fit=bounds')]">
          <div class="absolute inset-0 bg-black bg-opacity-50"></div>
          <div class="relative z-10 flex flex-col justify-end h-full p-6 text-left text-white">
            <div class="mb-4">
              <h2 class="text-2xl font-bold mb-4 mt-8">{{ $latestMovie->title }}</h2>
              <p class="mt-2 text-lg md:text-xl lg:text-2xl max-w-md">{{ $latestMovie->description }}</p>
            </div>
            <div class="flex space-x-4">
              <button class="px-6 py-3 text-lg font-semibold text-black bg-white rounded-md">Play</button>
              <button class="px-6 py-3 text-lg font-semibold text-white bg-gray-700 bg-opacity-70 rounded-md">More information</button>
            </div>
          </div>
        </div>
  </div>
  @endif
  <div class="flex flex-wrap lg:flex-nowrap"> 
    <div class="w-full lg:w-5/6 order-1 lg:order-1">
        <main class="container mx-auto bg-black px-5 -mt-5">
            <section class="mb-12 ">
                @foreach($moviesByGenre as $genreName => $movies)
                <h2 class="text-2xl font-bold mb-4 mt-8">{{ $genreName }}</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($movies as $movie)
                        <div class="duration-300 hover:scale-105 overflow-hidden rounded-xl relative group pb-4">
                          <div class="rounded-xl opacity-0 group-hover:opacity-100 transition duration-300 absolute from-black/80 bg-gradient-to-t inset-x-0 -bottom-2 text-white">
                                  <div class="p-4 space-y-3 text-xl group-hover:opacity-100 group-hover:translate-y-0 translate-y-4 pb-10 duration-300 ease-in-out">
                                      <div class="font-bold">{{ $movie->title }}</div>
                                      <div class="opacity-60 text-sm ">{{ $movie->description }}</div>
                                  </div>  
                          </div>
                          <img wire:click="selectMovie({{ $movie->id }})" class="h-auto max-w-full rounded-lg cursor-pointer" src="{{ $movie->image ? asset('storage/' . $movie->image) : '' }}" alt="{{ $movie->title }}" />
                          
                        </div>
                        @endforeach
                        @include('components.modals.mainBrowse')
                    </div>   
                @endforeach
            </section>   
        </main>
    </div>
    
      @livewire('browse.top-rated-movies')
 
  </div>
</div>
