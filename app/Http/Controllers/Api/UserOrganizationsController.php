<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrganizationResource;
use App\Http\Resources\OrganizationCollection;

class UserOrganizationsController extends Controller
{
    public function index(Request $request, User $user): OrganizationCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $organizations = $user
            ->organizations()
            ->search($search)
            ->latest()
            ->paginate();

        return new OrganizationCollection($organizations);
    }

    public function store(Request $request, User $user): OrganizationResource
    {
        $this->authorize('create', Organization::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'position' => ['required', 'max:255', 'string'],
            'start' => ['required', 'date'],
            'end' => ['required', 'date'],
            'description' => ['required', 'max:255', 'string'],
        ]);

        $organization = $user->organizations()->create($validated);

        return new OrganizationResource($organization);
    }
}
