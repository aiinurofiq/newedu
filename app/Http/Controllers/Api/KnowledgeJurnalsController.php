<?php

namespace App\Http\Controllers\Api;

use App\Models\Knowledge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\JurnalResource;
use App\Http\Resources\JurnalCollection;

class KnowledgeJurnalsController extends Controller
{
    public function index(
        Request $request,
        Knowledge $knowledge
    ): JurnalCollection {
        $this->authorize('view', $knowledge);

        $search = $request->get('search', '');

        $jurnals = $knowledge
            ->jurnals()
            ->search($search)
            ->latest()
            ->paginate();

        return new JurnalCollection($jurnals);
    }

    public function store(
        Request $request,
        Knowledge $knowledge
    ): JurnalResource {
        $this->authorize('create', Jurnal::class);

        $validated = $request->validate([
            'file' => ['nullable', 'file'],
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('public');
        }

        $jurnal = $knowledge->jurnals()->create($validated);

        return new JurnalResource($jurnal);
    }
}
