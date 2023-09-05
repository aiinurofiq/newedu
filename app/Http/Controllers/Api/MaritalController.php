<?php

namespace App\Http\Controllers\Api;

use App\Models\Marital;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\MaritalResource;
use App\Http\Resources\MaritalCollection;
use App\Http\Requests\MaritalStoreRequest;
use App\Http\Requests\MaritalUpdateRequest;

class MaritalController extends Controller
{
    public function index(Request $request): MaritalCollection
    {
        $this->authorize('view-any', Marital::class);

        $search = $request->get('search', '');

        $maritals = Marital::search($search)
            ->latest()
            ->paginate();

        return new MaritalCollection($maritals);
    }

    public function store(MaritalStoreRequest $request): MaritalResource
    {
        $this->authorize('create', Marital::class);

        $validated = $request->validated();

        $marital = Marital::create($validated);

        return new MaritalResource($marital);
    }

    public function show(Request $request, Marital $marital): MaritalResource
    {
        $this->authorize('view', $marital);

        return new MaritalResource($marital);
    }

    public function update(
        MaritalUpdateRequest $request,
        Marital $marital
    ): MaritalResource {
        $this->authorize('update', $marital);

        $validated = $request->validated();

        $marital->update($validated);

        return new MaritalResource($marital);
    }

    public function destroy(Request $request, Marital $marital): Response
    {
        $this->authorize('delete', $marital);

        $marital->delete();

        return response()->noContent();
    }
}
