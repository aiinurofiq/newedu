<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Fieldofposition;
use App\Http\Controllers\Controller;
use App\Http\Resources\PositionResource;
use App\Http\Resources\PositionCollection;

class FieldofpositionPositionsController extends Controller
{
    public function index(
        Request $request,
        Fieldofposition $fieldofposition
    ): PositionCollection {
        $this->authorize('view', $fieldofposition);

        $search = $request->get('search', '');

        $positions = $fieldofposition
            ->positions()
            ->search($search)
            ->latest()
            ->paginate();

        return new PositionCollection($positions);
    }

    public function store(
        Request $request,
        Fieldofposition $fieldofposition
    ): PositionResource {
        $this->authorize('create', Position::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'start' => ['required', 'date'],
            'end' => ['required', 'date'],
            'division_id' => ['required', 'exists:divisions,id'],
        ]);

        $position = $fieldofposition->positions()->create($validated);

        return new PositionResource($position);
    }
}
