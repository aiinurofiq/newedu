<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\KidResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\KidCollection;

class UserKidsController extends Controller
{
    public function index(Request $request, User $user): KidCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $kids = $user
            ->kids()
            ->search($search)
            ->latest()
            ->paginate();

        return new KidCollection($kids);
    }

    public function store(Request $request, User $user): KidResource
    {
        $this->authorize('create', Kid::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'city_id' => ['required', 'exists:cities,id'],
            'birth' => ['required', 'date'],
            'gender_id' => ['required', 'exists:genders,id'],
            'job' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
        ]);

        $kid = $user->kids()->create($validated);

        return new KidResource($kid);
    }
}
