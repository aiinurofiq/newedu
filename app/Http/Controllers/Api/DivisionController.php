<?php

namespace App\Http\Controllers\Api;

use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\DivisionResource;
use App\Http\Resources\DivisionCollection;
use App\Http\Requests\DivisionStoreRequest;
use App\Http\Requests\DivisionUpdateRequest;

class DivisionController extends Controller
{
    public function index(Request $request): DivisionCollection
    {
        $this->authorize('view-any', Division::class);

        $search = $request->get('search', '');

        $divisions = Division::search($search)
            ->latest()
            ->paginate();

        return new DivisionCollection($divisions);
    }

    public function store(DivisionStoreRequest $request): DivisionResource
    {
        $this->authorize('create', Division::class);

        $validated = $request->validated();

        $division = Division::create($validated);

        return new DivisionResource($division);
    }

    public function show(Request $request, Division $division): DivisionResource
    {
        $this->authorize('view', $division);

        return new DivisionResource($division);
    }

    public function update(
        DivisionUpdateRequest $request,
        Division $division
    ): DivisionResource {
        $this->authorize('update', $division);

        $validated = $request->validated();

        $division->update($validated);

        return new DivisionResource($division);
    }

    public function destroy(Request $request, Division $division): Response
    {
        $this->authorize('delete', $division);

        $division->delete();

        return response()->noContent();
    }
}
