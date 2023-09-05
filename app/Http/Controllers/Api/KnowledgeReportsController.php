<?php

namespace App\Http\Controllers\Api;

use App\Models\Knowledge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReportResource;
use App\Http\Resources\ReportCollection;

class KnowledgeReportsController extends Controller
{
    public function index(
        Request $request,
        Knowledge $knowledge
    ): ReportCollection {
        $this->authorize('view', $knowledge);

        $search = $request->get('search', '');

        $reports = $knowledge
            ->reports()
            ->search($search)
            ->latest()
            ->paginate();

        return new ReportCollection($reports);
    }

    public function store(
        Request $request,
        Knowledge $knowledge
    ): ReportResource {
        $this->authorize('create', Report::class);

        $validated = $request->validate([
            'file' => ['nullable', 'file'],
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('public');
        }

        $report = $knowledge->reports()->create($validated);

        return new ReportResource($report);
    }
}
