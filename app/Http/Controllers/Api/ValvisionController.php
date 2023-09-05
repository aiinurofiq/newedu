<?php

namespace App\Http\Controllers\Api;

use App\Models\Valvision;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ValvisionResource;
use App\Http\Resources\ValvisionCollection;
use App\Http\Requests\ValvisionStoreRequest;
use App\Http\Requests\ValvisionUpdateRequest;

class ValvisionController extends Controller
{
    public function index(Request $request): ValvisionCollection
    {
        $this->authorize('view-any', Valvision::class);

        $search = $request->get('search', '');

        $valvisions = Valvision::search($search)
            ->latest()
            ->paginate();

        return new ValvisionCollection($valvisions);
    }

    public function store(ValvisionStoreRequest $request): ValvisionResource
    {
        $this->authorize('create', Valvision::class);

        $validated = $request->validated();

        $valvision = Valvision::create($validated);

        return new ValvisionResource($valvision);
    }

    public function show(
        Request $request,
        Valvision $valvision
    ): ValvisionResource {
        $this->authorize('view', $valvision);

        return new ValvisionResource($valvision);
    }

    public function update(
        ValvisionUpdateRequest $request,
        Valvision $valvision
    ): ValvisionResource {
        $this->authorize('update', $valvision);

        $validated = $request->validated();

        $valvision->update($validated);

        return new ValvisionResource($valvision);
    }

    public function destroy(Request $request, Valvision $valvision): Response
    {
        $this->authorize('delete', $valvision);

        $valvision->delete();

        return response()->noContent();
    }
}
