@extends('layouts.app')

@section('content')

<!-- HERO SECTION -->
<div class="mb-16">
    <div id="featuredNewsCarousel" class="carousel slide relative rounded-xl shadow-lg overflow-hidden w-full" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($popularNews->take(5) as $i => $news)
                <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                    <img src="{{ $news['urlToImage'] ?? 'https://placehold.co/800x400?text=No+Image' }}"
                         class="d-block w-100" style="height: 500px; object-fit: cover;" alt="{{ $news['title'] }}">
                    <div class="carousel-caption d-none d-md-block bg-gradient-to-t from-black/80 via-black/60 to-transparent p-5 rounded-b-xl">
                        <h5 class="text-3xl font-bold text-white leading-snug shadow-md drop-shadow-md">{{ $news['title'] }}</h5>
                        <p class="mt-2 text-base text-gray-200 drop-shadow">{{ Str::limit($news['description'] ?? '', 100) }}</p>
                        <a href="{{ $news['url'] }}" target="_blank"
                           class="mt-3 inline-block bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-md transition duration-300 shadow">
                            🔗 Baca Selengkapnya
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#featuredNewsCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#featuredNewsCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
        </button>
    </div>
</div>

<!-- BERITA TERKINI & MOST READ -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-10 mb-16">
    <!-- BERITA TERKINI -->
    <div class="lg:col-span-2">
        <h2 class="text-3xl text-blue-900 mb-6 border-b-4 border-yellow-400 pb-2 font-semibold tracking-wide">📰 Berita Terkini</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach ($latestNews->take(9) as $news)
                <a href="{{ $news['url'] }}" target="_blank"
                   class="group block bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 border-l-8 border-blue-500 hover:border-yellow-400 overflow-hidden">
                    <img src="{{ $news['urlToImage'] ?? 'https://via.placeholder.com/400x200?text=No+Image' }}"
                         class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="p-4">
                        <span class="text-xs uppercase text-blue-600 tracking-wider">Terkini</span>
                        <h3 class="text-lg font-bold text-gray-800 mt-1 group-hover:text-blue-600 transition">{{ $news['title'] }}</h3>
                        <span class="text-sm text-blue-600 mt-2 inline-block">🔗 Baca Selengkapnya</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- SIDEBAR MOST READ -->
    <aside class="bg-white rounded-xl shadow-lg p-6 sticky top-24 h-fit border-l-8 border-green-500">
        <h2 class="text-2xl text-blue-900 mb-5 border-b-4 border-yellow-400 pb-2 font-semibold">📈 Most Read</h2>
        <div class="space-y-6">
            @foreach ($trendingNews->take(5) as $news)
                <article class="border-b border-gray-200 pb-5 last:border-none">
                    <a href="{{ $news['url'] }}" target="_blank"
                       class="text-base font-bold text-gray-900 hover:text-green-700 transition">{{ $news['title'] }}</a>
                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($news['description'], 90) }}</p>
                    <time class="text-xs text-gray-500 mt-2 block">🕒 27 Maret 2025</time>
                </article>
            @endforeach
        </div>
    </aside>
</div>

<!-- BERITA INDONESIA -->
<section class="mb-24">
    <h2 class="text-3xl text-blue-900 mb-6 border-b-4 border-yellow-400 pb-2 font-semibold tracking-wide">🇮🇩 Berita Indonesia</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach ($indonesiaNews as $news)
            <a href="{{ $news['link'] }}" target="_blank"
               class="group block bg-white rounded-xl border-l-8 border-red-500 shadow-md hover:shadow-xl transition duration-300 overflow-hidden">
                <img src="{{ $news['image_url'] ?? 'https://via.placeholder.com/400x200?text=No+Image' }}"
                     class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                <div class="p-4">
                    <span class="text-xs uppercase text-red-600 tracking-widest">Indonesia</span>
                    <h3 class="text-lg font-bold text-gray-800 mt-1 group-hover:text-red-600 transition">{{ $news['title'] }}</h3>
                    <span class="text-sm text-blue-600 mt-2 inline-block">🔗 Baca Selengkapnya</span>
                </div>
            </a>
        @endforeach
    </div>
</section>

@endsection
