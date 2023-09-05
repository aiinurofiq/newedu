<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\KnowledgeResource;
use App\Http\Resources\KnowledgeCollection;

class UserKnowledgesController extends Controller
{
    public function index(Request $request, User $user): KnowledgeCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $knowledges = $user
            ->knowledges()
            ->search($search)
            ->latest()
            ->paginate();

        return new KnowledgeCollection($knowledges);
    }

    public function store(Request $request, User $user): KnowledgeResource
    {
        $this->authorize('create', Knowledge::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'writer' => ['required', 'max:255', 'string'],
            'abstract' => ['required', 'max:255', 'string'],
            'status' => ['required', 'boolean'],
            'photo' => ['nullable', 'file'],
            'topic_id' => ['required', 'exists:topics,id'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('public');
        }

        $knowledge = $user->knowledges()->create($validated);

        return new KnowledgeResource($knowledge);
    }
}
