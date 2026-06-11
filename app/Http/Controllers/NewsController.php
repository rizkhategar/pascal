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

        $baseParams = [
            'paginate' => 100,
            'page' => 1,
        ];

        if ($request->filled('category_id') && $request->query('category_id') !== 'all') {
            $baseParams['category_id'] = $request->query('category_id');
        }

        if ($request->filled('category') && $request->query('category') !== 'all') {
            $baseParams['category'] = $request->query('category');
        }

        try {
            $firstResponse = $this->newsApiRequest($baseParams);

            if (! $firstResponse->successful()) {
                return response()->json([
                    'data' => [],
                    'meta' => $this->paginationMeta(1, 1, $perPage, 0),
                ]);
            }

            $firstPayload = $firstResponse->json();
            $lastPage = max(1, (int) data_get($firstPayload, 'meta.last_page', 1));
            $items = $this->extractNewsItems($firstPayload);

            if ($lastPage > 1) {
                foreach (array_chunk(range(2, $lastPage), 6) as $pageQueue) {
                    $responses = Http::pool(function (Pool $pool) use ($pageQueue, $baseParams) {
                        $requests = [];

                        foreach ($pageQueue as $queuedPage) {
                            $requests[(string) $queuedPage] = $pool
                                ->as((string) $queuedPage)
                                ->withoutVerifying()
                                ->acceptJson()
                                ->timeout(12)
                                ->get(self::NEWS_API_URL, array_merge($baseParams, [
                                    'page' => $queuedPage,
                                ]));
                        }

                        return $requests;
                    });

                    foreach ($responses as $response) {
                        if ($response->successful()) {
                            $items = $items->merge($this->extractNewsItems($response->json()));
                        }
                    }
                }
            }

            if ($query !== '') {
                $items = $items->filter(fn (array $item): bool => $this->matchesNewsQuery($item, $query));
            }

            $items = $items->values();
            $total = $items->count();
            $lastResultPage = max(1, (int) ceil($total / $perPage));
            $page = min($page, $lastResultPage);
            $pagedItems = $items->slice(($page - 1) * $perPage, $perPage)->values();

            return response()->json([
                'data' => $pagedItems,
                'meta' => $this->paginationMeta($page, $lastResultPage, $perPage, $total),
            ]);
        } catch (\Throwable $exception) {
            return response()->json([
                'data' => [],
                'meta' => $this->paginationMeta(1, 1, $perPage, 0),
                'message' => 'Berita belum dapat dimuat.',
            ], 500);
        }
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

    private function extractNewsItems(array $payload): Collection
    {
        $items = data_get($payload, 'data', []);

        if (! is_array($items)) {
            $items = data_get($payload, 'data.data', []);
        }

        return collect(is_array($items) ? $items : [])
            ->filter(fn ($item): bool => is_array($item))
            ->values();
    }

    private function matchesNewsQuery(array $item, string $query): bool
    {
        $category = data_get($item, 'category.name', '');
        $author = data_get($item, 'author.name', '');
        $content = implode(' ', [
            data_get($item, 'title', ''),
            strip_tags((string) data_get($item, 'excerpt', '')),
            strip_tags((string) data_get($item, 'content', '')),
            strip_tags((string) data_get($item, 'body', '')),
            $category,
            $author,
            data_get($item, 'publishedAt', ''),
            data_get($item, 'createdAt', ''),
        ]);

        return Str::of($content)->lower()->contains($query);
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
