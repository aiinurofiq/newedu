<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SocialResource;
use App\Http\Resources\SocialCollection;

class UserSocialsController extends Controller
{
    public function index(Request $request, User $user): SocialCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $socials = $user
            ->socials()
            ->search($search)
            ->latest()
            ->paginate();

        return new SocialCollection($socials);
    }

    public function store(Request $request, User $user): SocialResource
    {
        $this->authorize('create', Social::class);

        $validated = $request->validate([
            'category' => ['required', 'in:1,2,3,4,5'],
            'name' => ['required', 'max:255', 'string'],
        ]);

        $social = $user->socials()->create($validated);

        return new SocialResource($social);
    }
}
