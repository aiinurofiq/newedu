<?php

namespace App\Http\Controllers\Api;

use App\Models\Tribe;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TribeResource;
use App\Http\Resources\TribeCollection;
use App\Http\Requests\TribeStoreRequest;
use App\Http\Requests\TribeUpdateRequest;

class TribeController extends Controller
{
    public function index(Request $request): TribeCollection
    {
        $this->authorize('view-any', Tribe::class);

        $search = $request->get('search', '');

        $tribes = Tribe::search($search)
            ->latest()
            ->paginate();

        return new TribeCollection($tribes);
    }

    public function store(TribeStoreRequest $request): TribeResource
    {
        $this->authorize('create', Tribe::class);

        $validated = $request->validated();

        $tribe = Tribe::create($validated);

        return new TribeResource($tribe);
    }

    public function show(Request $request, Tribe $tribe): TribeResource
    {
        $this->authorize('view', $tribe);

        return new TribeResource($tribe);
    }

    public function update(
        TribeUpdateRequest $request,
        Tribe $tribe
    ): TribeResource {
        $this->authorize('update', $tribe);

        $validated = $request->validated();

        $tribe->update($validated);

        return new TribeResource($tribe);
    }

    public function destroy(Request $request, Tribe $tribe): Response
    {
        $this->authorize('delete', $tribe);

        $tribe->delete();

        return response()->noContent();
    }
}
