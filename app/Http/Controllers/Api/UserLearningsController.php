<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LearningResource;
use App\Http\Resources\LearningCollection;

class UserLearningsController extends Controller
{
    public function index(Request $request, User $user): LearningCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $learnings = $user
            ->learnings()
            ->search($search)
            ->latest()
            ->paginate();

        return new LearningCollection($learnings);
    }

    public function store(Request $request, User $user): LearningResource
    {
        $this->authorize('create', Learning::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'image' => ['nullable', 'image', 'max:1024'],
            'description' => ['required', 'max:255', 'string'],
            'type' => ['required', 'in:0,1,2'],
            'price' => ['nullable', 'numeric'],
            'categorylearn_id' => ['required', 'exists:categorylearns,id'],
            'level' => ['required', 'in:0,1,2,3'],
            'ispublic' => ['required', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $learning = $user->learnings()->create($validated);

        return new LearningResource($learning);
    }
}
