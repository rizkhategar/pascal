<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class NewsController extends Controller
{
    private string $apiBase = 'https://panel-web.unw.ac.id/api/news';

    public function show(string $slug): View
    {
        $news = null;
        $errorMessage = null;

        try {
            $response = Http::acceptJson()->timeout(12)->get($this->apiBase . '/' . $slug);

            if ($response->successful()) {
                $payload = $response->json();
                $news = $this->extractNewsItem($payload);
            }

            if (! $news) {
                $news = $this->findNewsFromList($slug);
            }
        } catch (ConnectionException $exception) {
            $errorMessage = 'Berita belum dapat dimuat karena koneksi ke API sedang bermasalah.';
        } catch (\Throwable $exception) {
            $errorMessage = 'Berita belum dapat dimuat dari API.';
        }

        abort_if(! $news && ! $errorMessage, 404);

        return view('news.show', [
            'news' => $news,
            'errorMessage' => $errorMessage,
        ]);
    }

    private function findNewsFromList(string $slug): ?array
    {
        $response = Http::acceptJson()->timeout(12)->get($this->apiBase, [
            'paginate' => 100,
            'page' => 1,
        ]);

        if (! $response->successful()) {
            return null;
        }

        $items = data_get($response->json(), 'data', []);

        if (! is_array($items)) {
            return null;
        }

        foreach ($items as $item) {
            if (data_get($item, 'slug') === $slug) {
                return $item;
            }
        }

        return null;
    }

    private function extractNewsItem(array $payload): ?array
    {
        if (isset($payload['id']) || isset($payload['slug'])) {
            return $payload;
        }

        $data = data_get($payload, 'data');

        if (is_array($data) && (isset($data['id']) || isset($data['slug']))) {
            return $data;
        }

        if (is_array($data) && isset($data[0]) && is_array($data[0])) {
            return $data[0];
        }

        return null;
    }
}
