<?php

namespace App\Http\Controllers\Api;

use App\Models\Bumnsector;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\BumnsectorResource;
use App\Http\Resources\BumnsectorCollection;
use App\Http\Requests\BumnsectorStoreRequest;
use App\Http\Requests\BumnsectorUpdateRequest;

class BumnsectorController extends Controller
{
    public function index(Request $request): BumnsectorCollection
    {
        $this->authorize('view-any', Bumnsector::class);

        $search = $request->get('search', '');

        $bumnsectors = Bumnsector::search($search)
            ->latest()
            ->paginate();

        return new BumnsectorCollection($bumnsectors);
    }

    public function store(BumnsectorStoreRequest $request): BumnsectorResource
    {
        $this->authorize('create', Bumnsector::class);

        $validated = $request->validated();

        $bumnsector = Bumnsector::create($validated);

        return new BumnsectorResource($bumnsector);
    }

    public function show(
        Request $request,
        Bumnsector $bumnsector
    ): BumnsectorResource {
        $this->authorize('view', $bumnsector);

        return new BumnsectorResource($bumnsector);
    }

    public function update(
        BumnsectorUpdateRequest $request,
        Bumnsector $bumnsector
    ): BumnsectorResource {
        $this->authorize('update', $bumnsector);

        $validated = $request->validated();

        $bumnsector->update($validated);

        return new BumnsectorResource($bumnsector);
    }

    public function destroy(Request $request, Bumnsector $bumnsector): Response
    {
        $this->authorize('delete', $bumnsector);

        $bumnsector->delete();

        return response()->noContent();
    }
}
