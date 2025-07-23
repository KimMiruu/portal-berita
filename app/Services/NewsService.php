<?php

namespace App\Services;

use GuzzleHttp\Client;

class NewsService
{
    private $client;
    private $apiKey;
    private $newsDataApiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = '6bfb0ceba27d477086a4a17272a293b6'; // API key NewsAPI
        $this->newsDataApiKey = 'pub_86943d2432558321990f342461bdf32346ebd'; // API key NewsData.io
    }

    // Mendapatkan berita trending dari NewsAPI
    public function getTrendingNews()
    {
        $url = 'https://newsapi.org/v2/top-headlines?country=us&pageSize=100&apiKey=' . $this->apiKey;
        $response = $this->client->get($url);
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['articles'] ?? [];
    }

    // Mendapatkan berita populer
    public function getPopularNews()
    {
        $url = 'https://newsapi.org/v2/everything?q=popular&sortBy=popularity&pageSize=100&apiKey=' . $this->apiKey;
        $response = $this->client->get($url);
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['articles'] ?? [];
    }

    // Mendapatkan berita Indonesia dari NewsData.io
    public function getIndonesiaNews()
    {
    $url = 'https://newsdata.io/api/1/latest?country=id&apikey=' . $this->newsDataApiKey;
    $response = $this->client->get($url);
    $data = json_decode($response->getBody()->getContents(), true);

    return $data['results'] ?? [];
    }


    // Mendapatkan berita terbaru
    public function getLatestNews()
    {
        $url = 'https://newsapi.org/v2/everything?q=latest&sortBy=publishedAt&language=en&pageSize=100&apiKey=' . $this->apiKey;
        $response = $this->client->get($url);
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['articles'] ?? [];
    }

    // Mendapatkan berita berdasarkan kategori
    public function getCategoryNews($category)
{
    $allResults = [];

    // Ambil 3 halaman dengan pageSize=100 (maksimum yang didukung oleh NewsAPI)
    for ($page = 1; $page <= 3; $page++) {
        $url = 'https://newsapi.org/v2/top-headlines?category=' . $category .
            '&pageSize=100&page=' . $page . '&language=en&apiKey=' . $this->apiKey;

        try {
            $response = $this->client->get($url);
            $data = json_decode($response->getBody()->getContents(), true);

            if (!empty($data['articles'])) {
                $allResults = array_merge($allResults, $data['articles']);
            }

            // Hentikan jika data kurang dari 100, artinya tidak ada data di page berikutnya
            if (count($data['articles']) < 100) break;

        } catch (\Exception $e) {
            continue;
        }
    }

    return $allResults;
}

}
