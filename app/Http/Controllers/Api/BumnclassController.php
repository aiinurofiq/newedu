<?php

namespace App\Http\Controllers\Api;

use App\Models\Bumnclass;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\BumnclassResource;
use App\Http\Resources\BumnclassCollection;
use App\Http\Requests\BumnclassStoreRequest;
use App\Http\Requests\BumnclassUpdateRequest;

class BumnclassController extends Controller
{
    public function index(Request $request): BumnclassCollection
    {
        $this->authorize('view-any', Bumnclass::class);

        $search = $request->get('search', '');

        $bumnclasses = Bumnclass::search($search)
            ->latest()
            ->paginate();

        return new BumnclassCollection($bumnclasses);
    }

    public function store(BumnclassStoreRequest $request): BumnclassResource
    {
        $this->authorize('create', Bumnclass::class);

        $validated = $request->validated();

        $bumnclass = Bumnclass::create($validated);

        return new BumnclassResource($bumnclass);
    }

    public function show(
        Request $request,
        Bumnclass $bumnclass
    ): BumnclassResource {
        $this->authorize('view', $bumnclass);

        return new BumnclassResource($bumnclass);
    }

    public function update(
        BumnclassUpdateRequest $request,
        Bumnclass $bumnclass
    ): BumnclassResource {
        $this->authorize('update', $bumnclass);

        $validated = $request->validated();

        $bumnclass->update($validated);

        return new BumnclassResource($bumnclass);
    }

    public function destroy(Request $request, Bumnclass $bumnclass): Response
    {
        $this->authorize('delete', $bumnclass);

        $bumnclass->delete();

        return response()->noContent();
    }
}
