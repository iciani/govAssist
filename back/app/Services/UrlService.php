<?php

namespace App\Services;

use App\Models\Url;
use Carbon\Carbon;

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

    public function clearUrlsUpdate(): int
    {
        $query = Url::whereDate('Updated_At', '<', Carbon::parse('Now -30 days'));
        $clearedCounter = $query->count();
        $query->delete();
        return $clearedCounter;
    }

    public function view(Url $url): void
    {
        $url->update(['views' => $url->views + 1]);
    }

    public function delete(Url $url): bool
    {
        return $url->delete();
    }
}
