<?php

namespace App\Http\Controllers\Api;

use App\Models\Knowledge;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\KnowledgeResource;
use App\Http\Resources\KnowledgeCollection;
use App\Http\Requests\KnowledgeStoreRequest;
use App\Http\Requests\KnowledgeUpdateRequest;

class KnowledgeController extends Controller
{
    public function index(Request $request): KnowledgeCollection
    {
        $this->authorize('view-any', Knowledge::class);

        $search = $request->get('search', '');

        $knowledges = Knowledge::search($search)
            ->latest()
            ->paginate();

        return new KnowledgeCollection($knowledges);
    }

    public function store(KnowledgeStoreRequest $request): KnowledgeResource
    {
        $this->authorize('create', Knowledge::class);

        $validated = $request->validated();
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('public');
        }

        $knowledge = Knowledge::create($validated);

        return new KnowledgeResource($knowledge);
    }

    public function show(
        Request $request,
        Knowledge $knowledge
    ): KnowledgeResource {
        $this->authorize('view', $knowledge);

        return new KnowledgeResource($knowledge);
    }

    public function update(
        KnowledgeUpdateRequest $request,
        Knowledge $knowledge
    ): KnowledgeResource {
        $this->authorize('update', $knowledge);

        $validated = $request->validated();

        if ($request->hasFile('photo')) {
            if ($knowledge->photo) {
                Storage::delete($knowledge->photo);
            }

            $validated['photo'] = $request->file('photo')->store('public');
        }

        $knowledge->update($validated);

        return new KnowledgeResource($knowledge);
    }

    public function destroy(Request $request, Knowledge $knowledge): Response
    {
        $this->authorize('delete', $knowledge);

        if ($knowledge->photo) {
            Storage::delete($knowledge->photo);
        }

        $knowledge->delete();

        return response()->noContent();
    }
}
