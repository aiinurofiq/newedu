<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AwardResource;
use App\Http\Resources\AwardCollection;

class UserAwardsController extends Controller
{
    public function index(Request $request, User $user): AwardCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $awards = $user
            ->awards()
            ->search($search)
            ->latest()
            ->paginate();

        return new AwardCollection($awards);
    }

    public function store(Request $request, User $user): AwardResource
    {
        $this->authorize('create', Award::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'from' => ['required', 'max:255', 'string'],
            'year' => ['required', 'numeric'],
            'scale' => ['required', 'in:1,2,3,4'],
        ]);

        $award = $user->awards()->create($validated);

        return new AwardResource($award);
    }
}
