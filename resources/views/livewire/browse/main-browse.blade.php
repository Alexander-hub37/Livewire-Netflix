<div>
@if ($latestMovie)
  <div class="relative h-[555px] w-full">
    <div class="bg-main large small">
      <div class="absolute inset-0 bg-black bg-opacity-25"></div>
        <div class="relative flex flex-col justify-end h-full p-6 text-left">
            <div class="mb-4">
                <h2 class="text-2xl uppercase font-bold">{{ $latestMovie->title }}</h2>
                <p class="mt-4 text-base md:text-2xl font-bold">{!! $latestMovie->description !!}</p>
            </div>
            <div class="flex space-x-4">
                <button class="px-6 py-3 text-lg font-semibold text-black bg-white rounded-md">Play</button>
                <button
                    class="px-6 py-3 text-lg font-semibold bg-gray-700 bg-opacity-70 rounded-md">More
                    information</button>
            </div>
        </div>
    </div>
  </div>
  
@endif
  <div class="flex flex-wrap md:flex-nowrap">
    <div class="w-full md:w-5/6 order-1 md:order-1">
      <main class="px-5">
        @foreach ($moviesByGenre as $genreName => $movies)
          <h2 class="text-2xl font-bold py-4">{{ $genreName }}</h2>
          <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
          @foreach ($movies as $movie)
            <div wire:click="selectMovie({{ $movie->id }})" class="container-image group">
              <div class="container-info group-hover:opacity-100">
                <div class="p-4 space-y-2 pb-6">
                    <div class="font-bold text-sm md:text-xl">{{ $movie->title }}</div>
                    <div class="opacity-60 text-sm ">{!! $movie->description !!}</div>
                </div>
              </div>
                <img class="max-w-full rounded-lg" src="{{ Storage::url($movie->image) }}" alt="{{ $movie->title }}"/>
            </div>
          @endforeach
          @include('components.modals.mainBrowse')
          </div>
        @endforeach
      </main>
    </div>

    <livewire:browse.top-rated-movies />

  </div>
</div>
