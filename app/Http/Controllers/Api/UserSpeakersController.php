<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SpeakerResource;
use App\Http\Resources\SpeakerCollection;

class UserSpeakersController extends Controller
{
    public function index(Request $request, User $user): SpeakerCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $speakers = $user
            ->speakers()
            ->search($search)
            ->latest()
            ->paginate();

        return new SpeakerCollection($speakers);
    }

    public function store(Request $request, User $user): SpeakerResource
    {
        $this->authorize('create', Speaker::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'organizer' => ['required', 'max:255', 'string'],
            'year' => ['required', 'numeric'],
            'address' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
        ]);

        $speaker = $user->speakers()->create($validated);

        return new SpeakerResource($speaker);
    }
}
