<?php

namespace App\Http\Controllers\Api;

use App\Models\Gender;
use Illuminate\Http\Request;
use App\Http\Resources\KidResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\KidCollection;

class GenderKidsController extends Controller
{
    public function index(Request $request, Gender $gender): KidCollection
    {
        $this->authorize('view', $gender);

        $search = $request->get('search', '');

        $kids = $gender
            ->kids()
            ->search($search)
            ->latest()
            ->paginate();

        return new KidCollection($kids);
    }

    public function store(Request $request, Gender $gender): KidResource
    {
        $this->authorize('create', Kid::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'city_id' => ['required', 'exists:cities,id'],
            'birth' => ['required', 'date'],
            'job' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
        ]);

        $kid = $gender->kids()->create($validated);

        return new KidResource($kid);
    }
}
