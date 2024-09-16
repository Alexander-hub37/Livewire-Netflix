<div class="w-full md:w-1/6 order-2 md:order-2">
    <main class="px-5 pb-4">
        <h2 class="text-2xl font-bold py-4">Top Rated</h2>
        <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
            @foreach ($topRatedMovies as $movie)
            <div class="container-image group">                        
                <div class="container-info group-hover:opacity-100">
                    <div class="p-4 space-y-2 pb-6">
                            <div class="font-bold text-2xl md:text-sm">{{ $movie->title }}</div>
                            {{$movie->qualifications_avg_value}}
                        </div>  
                </div>
                <img  class="max-w-full rounded-lg" src="{{ Storage::url($movie->image) }}" alt="{{ $movie->title }}"/>
            </div>
            @endforeach
        </div>
    </main>
</div>
