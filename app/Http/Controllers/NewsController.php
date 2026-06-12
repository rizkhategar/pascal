<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Pool;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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

        // 1. Ambil data dari cache hasil sinkronisasi Job
        $cachedNews = \Illuminate\Support\Facades\Cache::get('all_news_api_data');

        // 2. Jika Cache belum ada (misal job belum jalan), lakukan Fallback tarik API instan
        if (!$cachedNews) {
            \App\Jobs\SyncNewsApiJob::dispatch(); // Tetap perintahkan job berjalan di background
            
            $baseParams = ['paginate' => 100, 'page' => 1];
            $fallbackResponse = \Illuminate\Support\Facades\Http::withoutVerifying()
                                    ->timeout(10)->get(self::NEWS_API_URL, $baseParams);
                                    
            if ($fallbackResponse->successful()) {
                $cachedNews = $this->extractNewsItems($fallbackResponse->json());
            } else {
                $cachedNews = [];
            }
        }

        $items = collect($cachedNews);

        // 3. Filter berdasarkan Kategori
        if ($request->filled('category_id') && $request->query('category_id') !== 'all') {
            $catId = $request->query('category_id');
            $items = $items->filter(function ($item) use ($catId) {
                return data_get($item, 'category.id') == $catId || data_get($item, 'category_id') == $catId;
            });
        }

        // 4. Filter Pencarian Teks (Perbaikan Pencarian Cerdas)
        if ($query !== '') {
            $items = $items->filter(fn (array $item): bool => $this->matchesNewsQuery($item, $query));
        }

        $items = $items->values();
        $total = $items->count();
        $lastResultPage = max(1, (int) ceil($total / $perPage));
        
        // Pastikan $page tidak melebihi halaman terakhir jika hasil pencarian sedikit
        $page = min($page, max(1, $lastResultPage)); 
        
        $pagedItems = $items->slice(($page - 1) * $perPage, $perPage)->values();

        return response()->json([
            'data' => $pagedItems,
            'meta' => $this->paginationMeta($page, $lastResultPage, $perPage, $total),
        ]);
    }

    public function show(string $slug): View
    {
        return view('news.show', [
            'slug' => $slug,
        ]);
    }

    private function newsApiRequest(array $params)
    {
        return Http::withoutVerifying()
            ->acceptJson()
            ->timeout(12)
            ->retry(1, 250)
            ->get(self::NEWS_API_URL, $params);
    }

    // Ubah return menjadi array agar seragam dengan data yang disimpan dari Job Cache
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

    // SATU-SATUNYA fungsi matchesNewsQuery (yang lama sudah dihapus)
    private function matchesNewsQuery(array $item, string $query): bool
    {
        $title = strtolower((string) data_get($item, 'title', ''));
        $excerpt = strtolower(strip_tags((string) data_get($item, 'excerpt', '')));
        $content = strtolower(strip_tags((string) data_get($item, 'content', '')));
        $category = strtolower((string) data_get($item, 'category.name', ''));
        
        // Gabungkan semua teks relevan (termasuk kategori)
        $textToSearch = $title . ' ' . $excerpt . ' ' . $content . ' ' . $category;
        
        // Pecah query pencarian berdasarkan spasi (contoh: "jadwal akademik" -> dicari per kata)
        $keywords = array_filter(explode(' ', strtolower($query)));
        
        // Pastikan SEMUA kata kunci pencarian ada di dalam $textToSearch
        foreach ($keywords as $keyword) {
            if (strpos($textToSearch, $keyword) === false) {
                return false; // Jika satu kata saja tidak ketemu, berita diabaikan
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