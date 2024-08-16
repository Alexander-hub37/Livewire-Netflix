<div class="w-full lg:w-1/6 order-2 lg:order-2">
    <main class="container mx-auto bg-black px-5 -mt-5">
        <section class="mb-12">
            <h2 class="text-2xl font-bold mb-4 mt-8">Top Rated</h2>
            <div class="grid grid-cols-1 md:grid-cols-1">
                @foreach ($topRatedMovies as $movie)
                <div class="duration-300 hover:scale-105 overflow-hidden rounded-xl relative group pb-4">
                    <div class="rounded-xl opacity-0 group-hover:opacity-100 transition duration-300 absolute from-black/80 bg-gradient-to-t inset-x-0 -bottom-2 text-white">
                            <div class="p-4 space-y-3 text-xl group-hover:opacity-100 group-hover:translate-y-0 translate-y-4 pb-10 duration-300 ease-in-out">
                                <div class="font-bold">{{ $movie->title }}</div>
                                {{$movie->qualifications_avg_value}}
                            </div>  
                    </div>
                    <img  class="h-auto max-w-full rounded-lg" src="{{ $movie->image ? asset('storage/' . $movie->image) : '' }}" alt="{{ $movie->title }}" />
                </div>
                @endforeach
            </div>
        </section>
    </main>
</div>
