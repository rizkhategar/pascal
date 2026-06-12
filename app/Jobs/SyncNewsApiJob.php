<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Client\Pool;

class SyncNewsApiJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private const NEWS_API_URL = 'https://panel-web.unw.ac.id/api/news';

    /**
     * Waktu maksimum job boleh berjalan.
     */
    public $timeout = 600;

    public function handle(): void
    {
        $baseParams = ['paginate' => 100, 'page' => 1];
        
        // Ambil Halaman Pertama
        $firstResponse = Http::withoutVerifying()->timeout(15)->get(self::NEWS_API_URL, $baseParams);

        if (! $firstResponse->successful()) {
            return;
        }

        $firstPayload = $firstResponse->json();
        $lastPage = max(1, (int) data_get($firstPayload, 'meta.last_page', 1));
        $items = collect($this->extractNewsItems($firstPayload));

        // Ambil Sisa Halaman dengan Pool secara Chunk (Background Loading)
        if ($lastPage > 1) {
            foreach (array_chunk(range(2, $lastPage), 6) as $pageQueue) {
                $responses = Http::pool(function (Pool $pool) use ($pageQueue, $baseParams) {
                    $requests = [];
                    foreach ($pageQueue as $queuedPage) {
                        $requests[(string) $queuedPage] = $pool
                            ->as((string) $queuedPage)
                            ->withoutVerifying()
                            ->timeout(15)
                            ->get(self::NEWS_API_URL, array_merge($baseParams, ['page' => $queuedPage]));
                    }
                    return $requests;
                });

                foreach ($responses as $response) {
                    if ($response instanceof \Illuminate\Http\Client\Response && $response->successful()) {
                        $items = $items->merge($this->extractNewsItems($response->json()));
                    }
                }
                
                // Beri sedikit jeda agar tidak membebani limit API source
                sleep(1);
            }
        }

        // Cache seluruh berita selama 4 Jam (ataupun terserah kebutuhan realtime)
        Cache::put('all_news_api_data', $items->values()->toArray(), now()->addHours(4));
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
}