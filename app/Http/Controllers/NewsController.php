<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Pool;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NewsController extends Controller
{
    private const NEWS_API_URL = 'https://panel-web.unw.ac.id/api/news';

    public function index(): View
    {
        return view('news.index');
    }

    public function search(Request $request): JsonResponse
    {
        $query = Str::of((string) $request->query('q'))->lower()->trim()->toString();
        $page = max(1, (int) $request->query('page', 1));
        $perPage = min(30, max(1, (int) $request->query('paginate', 9)));

        // 1. Coba ambil seluruh data 1054+ dari Cache
        $cachedNews = \Illuminate\Support\Facades\Cache::get('all_news_api_data');

        // 2. Jika Cache kosong atau isinya terlalu sedikit (indikasi error sebelumnya), 
        // Lakukan sinkronisasi berkecepatan tinggi secara langsung!
        if (!$cachedNews || count($cachedNews) < 20) {
            $cachedNews = $this->fetchAllNewsFromApi();
        }

        $items = collect($cachedNews);

        // 3. Filter berdasarkan Kategori
        if ($request->filled('category_id') && $request->query('category_id') !== 'all') {
            $catId = $request->query('category_id');
            $items = $items->filter(function ($item) use ($catId) {
                return data_get($item, 'category.id') == $catId || data_get($item, 'category_id') == $catId;
            });
        }

        // 4. Filter Pencarian Teks
        if ($query !== '') {
            $items = $items->filter(fn (array $item): bool => $this->matchesNewsQuery($item, $query));
        }

        // 5. Filter Sorting (Terbaru / Terlama)
        $sort = $request->query('sort', 'desc'); // Default Terbaru
        $dateExtractor = function ($item) {
            return data_get($item, 'publishedAt') 
                ?? data_get($item, 'published_at') 
                ?? data_get($item, 'createdAt') 
                ?? data_get($item, 'created_at') 
                ?? '';
        };

        if ($sort === 'asc') {
            $items = $items->sortBy($dateExtractor);
        } else {
            $items = $items->sortByDesc($dateExtractor);
        }

        // 6. Terapkan Pagination dari Data yang Sudah Disaring & Diurutkan
        $items = $items->values();
        $total = $items->count();
        $lastResultPage = max(1, (int) ceil($total / $perPage));
        
        // Pastikan $page tidak melebihi halaman terakhir
        $page = min($page, max(1, $lastResultPage)); 
        
        $pagedItems = $items->slice(($page - 1) * $perPage, $perPage)->values();

        return response()->json([
            'data' => $pagedItems,
            'meta' => $this->paginationMeta($page, $lastResultPage, $perPage, $total),
        ]);
    }

    public function show(string $slug): View
    {
        return view('news.show', ['slug' => $slug]);
    }

    /**
     * Pengunduh Paralel API Berkecepatan Tinggi (Concurrent Fetcher)
     */
    private function fetchAllNewsFromApi(): array
    {
        // Matikan batas waktu eksekusi agar tidak timeout saat mengambil 1000+ data perdana
        set_time_limit(300);

        $items = collect();

        // Ambil halaman pertama dengan batas maksimum per page
        $baseParams = ['paginate' => 100, 'page' => 1];
        $firstResponse = Http::withoutVerifying()->timeout(20)->get(self::NEWS_API_URL, $baseParams);

        if (!$firstResponse->successful()) {
            return [];
        }

        $payload = $firstResponse->json();
        $items = $items->merge($this->extractNewsItems($payload));
        $lastPage = max(1, (int) data_get($payload, 'meta.last_page', 1));

        // Ambil sisa halaman secara paralel (barengan 10 request sekaligus) agar sangat cepat
        if ($lastPage > 1) {
            $pages = range(2, $lastPage);
            $chunks = array_chunk($pages, 10); 

            foreach ($chunks as $chunk) {
                $responses = Http::pool(function (Pool $pool) use ($chunk, $baseParams) {
                    $requests = [];
                    foreach ($chunk as $p) {
                        $requests[] = $pool->as((string) $p)
                            ->withoutVerifying()
                            ->timeout(20)
                            ->get(self::NEWS_API_URL, array_merge($baseParams, ['page' => $p]));
                    }
                    return $requests;
                });

                foreach ($responses as $response) {
                    if ($response instanceof \Illuminate\Http\Client\Response && $response->successful()) {
                        $items = $items->merge($this->extractNewsItems($response->json()));
                    }
                }
            }
        }

        $allData = $items->values()->toArray();

        // Simpan seluruh data 1054+ ke Cache selama 12 Jam agar super cepat diakses
        \Illuminate\Support\Facades\Cache::put('all_news_api_data', $allData, now()->addHours(12));

        return $allData;
    }

    private function extractNewsItems(array $payload): array 
    {
        $items = data_get($payload, 'data', []);
        if (! is_array($items)) {
            $items = data_get($payload, 'data.data', []);
        }
        return collect(is_array($items) ? $items : [])
            ->filter(fn ($item): bool => is_array($item))
            ->values()
            ->toArray(); 
    }

    private function matchesNewsQuery(array $item, string $query): bool
    {
        $title = strtolower((string) data_get($item, 'title', ''));
        $excerpt = strtolower(strip_tags((string) data_get($item, 'excerpt', '')));
        $content = strtolower(strip_tags((string) data_get($item, 'content', '')));
        $category = strtolower((string) data_get($item, 'category.name', ''));
        
        $textToSearch = $title . ' ' . $excerpt . ' ' . $content . ' ' . $category;
        $keywords = array_filter(explode(' ', strtolower($query)));
        
        foreach ($keywords as $keyword) {
            if (strpos($textToSearch, $keyword) === false) {
                return false; 
            }
        }
        return true;
    }

    private function paginationMeta(int $page, int $lastPage, int $perPage, int $total): array
    {
        return [
            'current_page' => $page,
            'last_page' => $lastPage,
            'per_page' => $perPage,
            'total' => $total,
        ];
    }
}