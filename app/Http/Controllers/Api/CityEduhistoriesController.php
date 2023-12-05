<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EduhistoryResource;
use App\Http\Resources\EduhistoryCollection;

class CityEduhistoriesController extends Controller
{
    public function index(Request $request, City $city): EduhistoryCollection
    {
        $this->authorize('view', $city);

        $search = $request->get('search', '');

        $eduhistories = $city
            ->eduhistories()
            ->search($search)
            ->latest()
            ->paginate();

        return new EduhistoryCollection($eduhistories);
    }

    public function store(Request $request, City $city): EduhistoryResource
    {
        $this->authorize('create', Eduhistory::class);

        $validated = $request->validate([
            'education_id' => ['required', 'exists:educations,id'],
            'major' => ['required', 'max:255', 'string'],
            'university_id' => ['required', 'exists:universities,id'],
            'year' => ['required', 'numeric'],
            'description' => ['required', 'max:255', 'string'],
        ]);

        $eduhistory = $city->eduhistories()->create($validated);

        return new EduhistoryResource($eduhistory);
    }
}
