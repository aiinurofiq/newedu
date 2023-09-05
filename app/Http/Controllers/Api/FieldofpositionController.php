<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Fieldofposition;
use App\Http\Controllers\Controller;
use App\Http\Resources\FieldofpositionResource;
use App\Http\Resources\FieldofpositionCollection;
use App\Http\Requests\FieldofpositionStoreRequest;
use App\Http\Requests\FieldofpositionUpdateRequest;

class FieldofpositionController extends Controller
{
    public function index(Request $request): FieldofpositionCollection
    {
        $this->authorize('view-any', Fieldofposition::class);

        $search = $request->get('search', '');

        $fieldofpositions = Fieldofposition::search($search)
            ->latest()
            ->paginate();

        return new FieldofpositionCollection($fieldofpositions);
    }

    public function store(
        FieldofpositionStoreRequest $request
    ): FieldofpositionResource {
        $this->authorize('create', Fieldofposition::class);

        $validated = $request->validated();

        $fieldofposition = Fieldofposition::create($validated);

        return new FieldofpositionResource($fieldofposition);
    }

    public function show(
        Request $request,
        Fieldofposition $fieldofposition
    ): FieldofpositionResource {
        $this->authorize('view', $fieldofposition);

        return new FieldofpositionResource($fieldofposition);
    }

    public function update(
        FieldofpositionUpdateRequest $request,
        Fieldofposition $fieldofposition
    ): FieldofpositionResource {
        $this->authorize('update', $fieldofposition);

        $validated = $request->validated();

        $fieldofposition->update($validated);

        return new FieldofpositionResource($fieldofposition);
    }

    public function destroy(
        Request $request,
        Fieldofposition $fieldofposition
    ): Response {
        $this->authorize('delete', $fieldofposition);

        $fieldofposition->delete();

        return response()->noContent();
    }
}
