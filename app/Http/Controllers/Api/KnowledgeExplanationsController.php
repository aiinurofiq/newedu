<?php

namespace App\Http\Controllers\Api;

use App\Models\Knowledge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExplanationResource;
use App\Http\Resources\ExplanationCollection;

class KnowledgeExplanationsController extends Controller
{
    public function index(
        Request $request,
        Knowledge $knowledge
    ): ExplanationCollection {
        $this->authorize('view', $knowledge);

        $search = $request->get('search', '');

        $explanations = $knowledge
            ->explanations()
            ->search($search)
            ->latest()
            ->paginate();

        return new ExplanationCollection($explanations);
    }

    public function store(
        Request $request,
        Knowledge $knowledge
    ): ExplanationResource {
        $this->authorize('create', Explanation::class);

        $validated = $request->validate([
            'file' => ['nullable', 'file'],
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('public');
        }

        $explanation = $knowledge->explanations()->create($validated);

        return new ExplanationResource($explanation);
    }
}
