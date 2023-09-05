<?php

namespace App\Http\Controllers\Api;

use App\Models\Religion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReligionResource;
use App\Http\Resources\ReligionCollection;
use App\Http\Requests\ReligionStoreRequest;
use App\Http\Requests\ReligionUpdateRequest;

class ReligionController extends Controller
{
    public function index(Request $request): ReligionCollection
    {
        $this->authorize('view-any', Religion::class);

        $search = $request->get('search', '');

        $religions = Religion::search($search)
            ->latest()
            ->paginate();

        return new ReligionCollection($religions);
    }

    public function store(ReligionStoreRequest $request): ReligionResource
    {
        $this->authorize('create', Religion::class);

        $validated = $request->validated();

        $religion = Religion::create($validated);

        return new ReligionResource($religion);
    }

    public function show(Request $request, Religion $religion): ReligionResource
    {
        $this->authorize('view', $religion);

        return new ReligionResource($religion);
    }

    public function update(
        ReligionUpdateRequest $request,
        Religion $religion
    ): ReligionResource {
        $this->authorize('update', $religion);

        $validated = $request->validated();

        $religion->update($validated);

        return new ReligionResource($religion);
    }

    public function destroy(Request $request, Religion $religion): Response
    {
        $this->authorize('delete', $religion);

        $religion->delete();

        return response()->noContent();
    }
}
