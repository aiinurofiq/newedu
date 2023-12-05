<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PositionResource;
use App\Http\Resources\PositionCollection;

class UserPositionsController extends Controller
{
    public function index(Request $request, User $user): PositionCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $positions = $user
            ->positions()
            ->search($search)
            ->latest()
            ->paginate();

        return new PositionCollection($positions);
    }

    public function store(Request $request, User $user): PositionResource
    {
        $this->authorize('create', Position::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'start' => ['required', 'date'],
            'end' => ['required', 'date'],
            'fieldofposition_id' => ['required', 'exists:fieldofpositions,id'],
            'division_id' => ['required', 'exists:divisions,id'],
        ]);

        $position = $user->positions()->create($validated);

        return new PositionResource($position);
    }
}
