<?php

namespace App\Services;

use App\Models\Url;

class UrlService
{
    public function create(array $url): Url
    {
        return Url::create($url)->fresh();
    }

    public function stateUpdate(Url $url, $state): void
    {
        $url->update(['state' => $state]);
    }

    public function view(Url $url): void
    {
        $url->update(['views' => $url->views + 1 ]);
    }

    public function delete(Url $url): bool
    {
        return $url->delete();
    }
}
