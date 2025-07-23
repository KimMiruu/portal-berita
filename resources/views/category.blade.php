@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">

    <!-- Judul Kategori: lebih hidup dan berwarna -->
    <div class="mb-12 text-center">
        <div class="inline-block px-6 py-3 bg-gradient-to-r from-yellow-400 via-red-400 to-pink-500 rounded-full shadow-lg animate-pulse">
            <h1 class="text-3xl md:text-4xl font-extrabold text-white tracking-wide">
                📁 Berita Kategori: {{ ucfirst($category) }}
            </h1>
        </div>
        <p class="text-gray-600 mt-3 text-lg">
            Temukan berbagai informasi menarik di kategori <strong>{{ ucfirst($category) }}</strong> hari ini.
        </p>
        <div class="mt-4 flex justify-center">
            <div class="w-32 h-1 bg-blue-600 rounded-full"></div>
        </div>
    </div>

    <!-- Grid Berita -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
        @forelse ($news as $item)
            <a href="{{ $item['url'] ?? $item['link'] ?? '#' }}" target="_blank"
               class="group relative bg-white border border-gray-200 rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition duration-300">
                <div class="relative">
                    <img src="{{ $item['urlToImage'] ?? 'https://via.placeholder.com/400x250?text=No+Image' }}"
                         alt="Gambar Berita"
                         class="w-full h-52 object-cover rounded-t-xl">
                    <div class="absolute top-2 right-2 bg-blue-600 text-white text-xs px-3 py-1 rounded-full shadow">
                        📰 News
                    </div>
                </div>
                <div class="p-5">
                    <h2 class="text-lg font-bold text-gray-900 group-hover:text-blue-700 transition duration-300">
                        {{ Str::limit($item['title'], 90) }}
                    </h2>
                    <p class="text-sm text-gray-600 mt-2">{{ Str::limit($item['description'] ?? 'Tidak ada deskripsi.', 100) }}</p>
                    <span class="inline-block mt-4 text-sm font-semibold text-blue-600 hover:text-blue-800 transition">
                        🔗 Baca Selengkapnya
                    </span>
                </div>
            </a>
        @empty
            <div class="col-span-full text-center text-red-400 text-xl font-semibold">
                😢 Tidak ada berita untuk kategori ini.
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if ($news instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="mt-14 flex flex-wrap justify-center items-center gap-3">
            @if ($news->onFirstPage())
                <span class="px-4 py-2 bg-gray-300 text-gray-500 rounded-md cursor-not-allowed">← Prev</span>
            @else
                <a href="{{ $news->previousPageUrl() }}"
                   class="px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-md hover:brightness-110 transition">
                   ← Prev
                </a>
            @endif

            @foreach (range(1, $news->lastPage()) as $page)
                @if ($page == $news->currentPage())
                    <span class="px-4 py-2 bg-indigo-700 text-white font-semibold rounded-md shadow">{{ $page }}</span>
                @else
                    <a href="{{ $news->url($page) }}"
                       class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-blue-100 transition">{{ $page }}</a>
                @endif
            @endforeach

            @if ($news->hasMorePages())
                <a href="{{ $news->nextPageUrl() }}"
                   class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-blue-500 text-white rounded-md hover:brightness-110 transition">
                   Next →
                </a>
            @else
                <span class="px-4 py-2 bg-gray-300 text-gray-500 rounded-md cursor-not-allowed">Next →</span>
            @endif
        </div>
    @endif
</div>
@endsection
