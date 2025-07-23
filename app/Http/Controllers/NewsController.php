<?php
// app/Http/Controllers/NewsController.php

namespace App\Http\Controllers;

use App\Services\NewsService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsController extends Controller
{
    protected $newsService;

    // Menggunakan dependency injection untuk memasukkan NewsService
    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    // Method untuk menampilkan berita trending, populer, dan Indonesia
    public function index()
    {
        $trendingNews = collect($this->newsService->getTrendingNews())->take(70);
        $popularNews = collect($this->newsService->getPopularNews())->take(70);
        $indonesiaNews = collect($this->newsService->getIndonesiaNews())->take(20);
        $latestNews = collect($this->newsService->getLatestNews())->take(70); // Tambahkan ini

        return view('dashboard', compact('trendingNews', 'popularNews', 'indonesiaNews', 'latestNews'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        // Ambil data langsung dari service
        $popularNews = collect($this->newsService->getPopularNews())->take(70);
        $trendingNews = collect($this->newsService->getTrendingNews())->take(70);
        $indonesiaNews = collect($this->newsService->getIndonesiaNews())->take(20);

        $allNews = $popularNews->merge($trendingNews)->merge($indonesiaNews);

        $filteredNews = $allNews->filter(function ($item) use ($query) {
            return stripos($item['title'], $query) !== false;
        });

        return view('search-results', [
            'query' => $query,
            'results' => $filteredNews,
        ]);
    }

    // Method showByCategory dengan pagination manual
public function showByCategory(Request $request, $category)
{
    $allNews = collect($this->newsService->getCategoryNews($category)); // Ambil semua berita kategori
    $perPage = 20; // Ubah sesuai jumlah berita yang diinginkan per halaman

    $currentPage = $request->get('page', 1); // Ambil page dari query parameter, default 1
    $currentItems = $allNews->slice(($currentPage - 1) * $perPage, $perPage)->values(); // Potong data sesuai page

    $paginatedNews = new LengthAwarePaginator(
        $currentItems,
        $allNews->count(),
        $perPage,
        $currentPage,
        [
            'path' => $request->url(),
            'query' => $request->query(),
        ]
    );

    return view('category', [
        'category' => ucfirst($category),
        'news' => $paginatedNews,
    ]);
}

}
