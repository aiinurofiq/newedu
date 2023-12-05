<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\InterestResource;
use App\Http\Resources\InterestCollection;

class UserInterestsController extends Controller
{
    public function index(Request $request, User $user): InterestCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $interests = $user
            ->interests()
            ->search($search)
            ->latest()
            ->paginate();

        return new InterestCollection($interests);
    }

    public function store(Request $request, User $user): InterestResource
    {
        $this->authorize('create', Interest::class);

        $validated = $request->validate([
            'description' => ['required', 'max:255', 'string'],
        ]);

        $interest = $user->interests()->create($validated);

        return new InterestResource($interest);
    }
}
