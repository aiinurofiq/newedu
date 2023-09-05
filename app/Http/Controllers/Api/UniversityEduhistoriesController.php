<?php

namespace App\Http\Controllers\Api;

use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EduhistoryResource;
use App\Http\Resources\EduhistoryCollection;

class UniversityEduhistoriesController extends Controller
{
    public function index(
        Request $request,
        University $university
    ): EduhistoryCollection {
        $this->authorize('view', $university);

        $search = $request->get('search', '');

        $eduhistories = $university
            ->eduhistories()
            ->search($search)
            ->latest()
            ->paginate();

        return new EduhistoryCollection($eduhistories);
    }

    public function store(
        Request $request,
        University $university
    ): EduhistoryResource {
        $this->authorize('create', Eduhistory::class);

        $validated = $request->validate([
            'education_id' => ['required', 'exists:educations,id'],
            'major' => ['required', 'max:255', 'string'],
            'city_id' => ['required', 'exists:cities,id'],
            'year' => ['required', 'numeric'],
            'description' => ['required', 'max:255', 'string'],
        ]);

        $eduhistory = $university->eduhistories()->create($validated);

        return new EduhistoryResource($eduhistory);
    }
}
