<?php

namespace App\Http\Controllers;

use App\Enums\UrlStates;
use App\Helpers\JsonHelper;
use App\Http\Requests\Url\UrlIndexRequest;
use App\Http\Requests\Url\UrlStoreRequest;
use App\Http\Requests\Url\UrlStateUpdateRequest;
use App\Http\Resources\UrlResource;
use App\Models\Url;
use App\Services\UrlService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use \Illuminate\Http\RedirectResponse;

class UrlController extends Controller
{
    public function __construct(public readonly UrlService $urlService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(UrlIndexRequest $request): AnonymousResourceCollection | JsonResponse
    {
        $paginatedData = Url::filter($request)->paginate($request->per_page ?? 10);
        return UrlResource::collection($paginatedData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UrlStoreRequest $request): JsonResponse
    {
        $url = $this->urlService->create($request->validated());
        return JsonHelper::success([
            'data' => new UrlResource($url)
        ], Response::HTTP_OK);
    }

    /**
     * Update the Urls State.
     */
    public function stateUpdate(UrlStateUpdateRequest $request): JsonResponse
    {
        $params = $request->validated();
        $this->urlService->stateUpdate(Url::find($params['id']), $params['state']);
        return JsonHelper::success();
    }

    /**
     * Show a resource from storage.
     */
    public function show(Url $url): JsonResponse
    {
        return JsonHelper::success([
            'data' => new UrlResource($url)
        ]);
    }

    /**
     * Redirect to the long URL.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect(Url $url): RedirectResponse
    {
        $this->urlService->view($url);
        return $url->state === UrlStates::ACTIVE->value ? redirect($url->destination) : abort(404);
    }

    /**
     * Destroy a resource in storage.
     */
    public function destroy(Url $url): JsonResponse
    {
        $this->urlService->delete($url);
        return JsonHelper::success();
    }
}
