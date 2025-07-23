@extends('layouts.app')

@section('content')

<!-- Hero Section: Carousel dari Berita Terpopuler -->
<div class="mb-16">
    <div id="featuredNewsCarousel" class="carousel slide relative rounded-xl shadow-xl overflow-hidden w-full max-w-full" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($popularNews->take(5) as $i => $news)
                <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                    <img src="{{ $news['urlToImage'] ?? 'https://placehold.co/800x400?text=No+Image' }}"
                         class="d-block w-100 rounded-xl" style="height: 500px; object-fit: cover;"
                         alt="{{ $news['title'] }}">
                    <div class="carousel-caption d-none d-md-block bg-black bg-opacity-50 p-4 rounded-xl">
                        <h5 class="text-2xl text-white leading-tight font-bold">{{ $news['title'] }}</h5>
                        <p class="text-base text-gray-200 mt-2">{{ Str::limit($news['description'] ?? '', 100) }}</p>
                        <a href="{{ $news['url'] }}" target="_blank"
                           class="inline-block mt-3 bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded shadow-lg transition duration-300">
                            🔗 Baca Selengkapnya →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#featuredNewsCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#featuredNewsCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<!-- Kategori: Berita Terkini + Most Read -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-10 mb-16">
    <!-- Berita Terkini -->
    <div class="lg:col-span-2">
        <h2 class="text-3xl text-blue-900 mb-8 border-b-4 border-yellow-400 pb-3 tracking-wide select-none">
            📰 Berita Terkini
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach ($latestNews->take(9) as $news)
                <a href="{{ $news['url'] ?? '#' }}" target="_blank" 
                   class="block bg-white rounded-xl border-l-8 border-blue-500 shadow-md hover:shadow-xl transition duration-300 ease-in-out group overflow-hidden">
                    <img src="{{ $news['urlToImage'] ?? 'https://via.placeholder.com/400x200?text=No+Image' }}" 
                         class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300 ease-in-out">
                    <div class="p-5">
                        <span class="text-sm uppercase tracking-widest text-blue-600 select-none">Terkini</span>
                        <h3 class="text-gray-900 text-[18px] font-bold mt-2 group-hover:text-blue-600 transition duration-300 leading-snug tracking-wide">
                            {{ $news['title'] }}
                        </h3>
                        <span class="inline-block text-blue-600 text-sm mt-3">🔗 Baca Selengkapnya</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

   <!-- Most Read Sidebar -->
<aside class="bg-white rounded-xl shadow-lg p-6 sticky top-24 h-fit border-l-8 border-green-500">
    <h2 class="text-3xl text-blue-900 mb-8 border-b-4 border-yellow-400 pb-3 select-none tracking-wide">
        📈 Most Read
    </h2>
    <div class="space-y-8">
        @foreach ($trendingNews->take(5) as $news)
            <article class="border-b border-gray-200 pb-5 last:border-0 last:pb-0">
                <a href="{{ $news['url'] }}" target="_blank" 
                   class="text-lg text-gray-900 hover:text-green-700 transition duration-300 tracking-wide font-bold">
                    {{ $news['title'] }}
                </a>
                <p class="text-base text-gray-600 mt-2 leading-relaxed line-clamp-3">
                    {{ Str::limit($news['description'], 90) }}
                </p>
                <time class="text-sm text-gray-500 mt-3 block select-none">🕒 27 Maret 2025</time>
            </article>
        @endforeach
    </div>
</aside>
</div>

<!-- Berita Indonesia -->
<section class="mb-24">
    <h2 class="text-4xl text-blue-900 mb-10 border-b-4 border-yellow-400 pb-3 select-none tracking-wide">
        🇮🇩 Berita Indonesia
    </h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
        @foreach ($indonesiaNews as $news)
            <a href="{{ $news['link'] ?? '#' }}" target="_blank" 
               class="block bg-white rounded-xl border-l-8 border-red-500 shadow-md hover:shadow-xl transition duration-300 ease-in-out overflow-hidden group">
                <img src="{{ $news['image_url'] ?? 'https://via.placeholder.com/400x200?text=No+Image' }}" 
                     class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300 ease-in-out">
                <div class="p-5">
                    <span class="text-sm uppercase tracking-widest text-red-600 select-none">Indonesia</span>
                    <h3 class="text-gray-800 text-[18px] font-bold mt-2 hover:text-red-600 transition duration-300 leading-snug tracking-wide">
                        {{ $news['title'] }}
                    </h3>
                    <span class="inline-block text-blue-600 text-sm mt-3">🔗 Baca Selengkapnya</span>
                </div>
            </a>
        @endforeach
    </div>
</section>


@endsection
