<?php

namespace App\Http\Controllers\Api;

use App\Models\Gender;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\WifhusResource;
use App\Http\Resources\WifhusCollection;

class GenderWifhusesController extends Controller
{
    public function index(Request $request, Gender $gender): WifhusCollection
    {
        $this->authorize('view', $gender);

        $search = $request->get('search', '');

        $wifhuses = $gender
            ->wifhuses()
            ->search($search)
            ->latest()
            ->paginate();

        return new WifhusCollection($wifhuses);
    }

    public function store(Request $request, Gender $gender): WifhusResource
    {
        $this->authorize('create', Wifhus::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'city_id' => ['required', 'exists:cities,id'],
            'birth' => ['required', 'date'],
            'as' => ['required', 'in:1,2'],
            'job' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
            'maritaldate' => ['required', 'date'],
        ]);

        $wifhus = $gender->wifhuses()->create($validated);

        return new WifhusResource($wifhus);
    }
}
