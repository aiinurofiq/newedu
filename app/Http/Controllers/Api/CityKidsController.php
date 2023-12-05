<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Resources\KidResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\KidCollection;

class CityKidsController extends Controller
{
    public function index(Request $request, City $city): KidCollection
    {
        $this->authorize('view', $city);

        $search = $request->get('search', '');

        $kids = $city
            ->kids()
            ->search($search)
            ->latest()
            ->paginate();

        return new KidCollection($kids);
    }

    public function store(Request $request, City $city): KidResource
    {
        $this->authorize('create', Kid::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'birth' => ['required', 'date'],
            'gender_id' => ['required', 'exists:genders,id'],
            'job' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
        ]);

        $kid = $city->kids()->create($validated);

        return new KidResource($kid);
    }
}
