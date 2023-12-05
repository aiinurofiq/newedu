<?php

namespace App\Http\Controllers\Api;

use App\Models\Bloodtype;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\BloodtypeResource;
use App\Http\Resources\BloodtypeCollection;
use App\Http\Requests\BloodtypeStoreRequest;
use App\Http\Requests\BloodtypeUpdateRequest;

class BloodtypeController extends Controller
{
    public function index(Request $request): BloodtypeCollection
    {
        $this->authorize('view-any', Bloodtype::class);

        $search = $request->get('search', '');

        $bloodtypes = Bloodtype::search($search)
            ->latest()
            ->paginate();

        return new BloodtypeCollection($bloodtypes);
    }

    public function store(BloodtypeStoreRequest $request): BloodtypeResource
    {
        $this->authorize('create', Bloodtype::class);

        $validated = $request->validated();

        $bloodtype = Bloodtype::create($validated);

        return new BloodtypeResource($bloodtype);
    }

    public function show(
        Request $request,
        Bloodtype $bloodtype
    ): BloodtypeResource {
        $this->authorize('view', $bloodtype);

        return new BloodtypeResource($bloodtype);
    }

    public function update(
        BloodtypeUpdateRequest $request,
        Bloodtype $bloodtype
    ): BloodtypeResource {
        $this->authorize('update', $bloodtype);

        $validated = $request->validated();

        $bloodtype->update($validated);

        return new BloodtypeResource($bloodtype);
    }

    public function destroy(Request $request, Bloodtype $bloodtype): Response
    {
        $this->authorize('delete', $bloodtype);

        $bloodtype->delete();

        return response()->noContent();
    }
}
