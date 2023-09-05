<?php

namespace App\Http\Controllers\Api;

use App\Models\Knowledge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExsumResource;
use App\Http\Resources\ExsumCollection;

class KnowledgeExsumsController extends Controller
{
    public function index(
        Request $request,
        Knowledge $knowledge
    ): ExsumCollection {
        $this->authorize('view', $knowledge);

        $search = $request->get('search', '');

        $exsums = $knowledge
            ->exsums()
            ->search($search)
            ->latest()
            ->paginate();

        return new ExsumCollection($exsums);
    }

    public function store(Request $request, Knowledge $knowledge): ExsumResource
    {
        $this->authorize('create', Exsum::class);

        $validated = $request->validate([
            'file' => ['nullable', 'file'],
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('public');
        }

        $exsum = $knowledge->exsums()->create($validated);

        return new ExsumResource($exsum);
    }
}
