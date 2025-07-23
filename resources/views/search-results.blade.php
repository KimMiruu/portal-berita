@extends('layouts.app')


@section('content')
    <h2 class="text-2xl font-bold text-blue-800 mb-4">Hasil pencarian untuk: "{{ $query }}"</h2>

    @if($results->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($results as $news)
                <a href="{{ $news['url'] ?? '#' }}" target="_blank" class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                    <img src="{{ $news['urlToImage'] ?? 'https://via.placeholder.com/400x250?text=No+Image' }}" alt="Gambar Berita" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-semibold text-lg">{{ Str::limit($news['title'], 100) }}</h3>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <p class="text-gray-600">Tidak ditemukan berita dengan kata kunci "{{ $query }}".</p>
    @endif
@endsection
