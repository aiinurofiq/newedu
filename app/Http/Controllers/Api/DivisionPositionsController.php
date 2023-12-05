<?php

namespace App\Http\Controllers\Api;

use App\Models\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PositionResource;
use App\Http\Resources\PositionCollection;

class DivisionPositionsController extends Controller
{
    public function index(
        Request $request,
        Division $division
    ): PositionCollection {
        $this->authorize('view', $division);

        $search = $request->get('search', '');

        $positions = $division
            ->positions()
            ->search($search)
            ->latest()
            ->paginate();

        return new PositionCollection($positions);
    }

    public function store(
        Request $request,
        Division $division
    ): PositionResource {
        $this->authorize('create', Position::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'start' => ['required', 'date'],
            'end' => ['required', 'date'],
            'fieldofposition_id' => ['required', 'exists:fieldofpositions,id'],
        ]);

        $position = $division->positions()->create($validated);

        return new PositionResource($position);
    }
}
