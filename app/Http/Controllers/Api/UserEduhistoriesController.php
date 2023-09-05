<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EduhistoryResource;
use App\Http\Resources\EduhistoryCollection;

class UserEduhistoriesController extends Controller
{
    public function index(Request $request, User $user): EduhistoryCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $eduhistories = $user
            ->eduhistories()
            ->search($search)
            ->latest()
            ->paginate();

        return new EduhistoryCollection($eduhistories);
    }

    public function store(Request $request, User $user): EduhistoryResource
    {
        $this->authorize('create', Eduhistory::class);

        $validated = $request->validate([
            'education_id' => ['required', 'exists:educations,id'],
            'major' => ['required', 'max:255', 'string'],
            'university_id' => ['required', 'exists:universities,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'year' => ['required', 'numeric'],
            'description' => ['required', 'max:255', 'string'],
        ]);

        $eduhistory = $user->eduhistories()->create($validated);

        return new EduhistoryResource($eduhistory);
    }
}
