<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $apiKey = env('NEWS_API_KEY'); // Kita simpan API Key di file .env
        $response = Http::get("https://newsapi.org/v2/top-headlines", [
            'country' => 'id', // Berita dari Indonesia
            'pageSize' => 10,
            'apiKey' => $apiKey,
        ]);

        $articles = $response->json()['articles'] ?? [];

        return view('dashboard', compact('articles'));
    }
}
