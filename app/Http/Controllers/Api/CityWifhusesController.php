<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\WifhusResource;
use App\Http\Resources\WifhusCollection;

class CityWifhusesController extends Controller
{
    public function index(Request $request, City $city): WifhusCollection
    {
        $this->authorize('view', $city);

        $search = $request->get('search', '');

        $wifhuses = $city
            ->wifhuses()
            ->search($search)
            ->latest()
            ->paginate();

        return new WifhusCollection($wifhuses);
    }

    public function store(Request $request, City $city): WifhusResource
    {
        $this->authorize('create', Wifhus::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'birth' => ['required', 'date'],
            'gender_id' => ['required', 'exists:genders,id'],
            'as' => ['required', 'in:1,2'],
            'job' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
            'maritaldate' => ['required', 'date'],
        ]);

        $wifhus = $city->wifhuses()->create($validated);

        return new WifhusResource($wifhus);
    }
}
