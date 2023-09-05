<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ValvisionResource;
use App\Http\Resources\ValvisionCollection;

class UserValvisionsController extends Controller
{
    public function index(Request $request, User $user): ValvisionCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $valvisions = $user
            ->valvisions()
            ->search($search)
            ->latest()
            ->paginate();

        return new ValvisionCollection($valvisions);
    }

    public function store(Request $request, User $user): ValvisionResource
    {
        $this->authorize('create', Valvision::class);

        $validated = $request->validate([
            'value' => ['required', 'max:255', 'string'],
            'vision' => ['required', 'max:255', 'string'],
        ]);

        $valvision = $user->valvisions()->create($validated);

        return new ValvisionResource($valvision);
    }
}
