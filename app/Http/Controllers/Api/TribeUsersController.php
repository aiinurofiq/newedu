<?php

namespace App\Http\Controllers\Api;

use App\Models\Tribe;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserCollection;

class TribeUsersController extends Controller
{
    public function index(Request $request, Tribe $tribe): UserCollection
    {
        $this->authorize('view', $tribe);

        $search = $request->get('search', '');

        $users = $tribe
            ->users()
            ->search($search)
            ->latest()
            ->paginate();

        return new UserCollection($users);
    }

    public function store(Request $request, Tribe $tribe): UserResource
    {
        $this->authorize('create', User::class);

        $validated = $request->validate([
            'uuid' => ['nullable', 'unique:users,uuid', 'max:255'],
            'kopeg' => ['required', 'unique:users,kopeg', 'max:255', 'string'],
            'nik' => ['required', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'city_id' => ['required', 'exists:cities,id'],
            'birth' => ['required', 'date'],
            'gender_id' => ['required', 'exists:genders,id'],
            'religion_id' => ['required', 'exists:religions,id'],
            'address' => ['required', 'max:255', 'string'],
            'phone' => ['required', 'max:255', 'string'],
            'email' => ['required', 'unique:users,email', 'email'],
            'npwp' => ['required', 'max:255', 'string'],
            'bloodtype_id' => ['required', 'exists:bloodtypes,id'],
            'marital_id' => ['required', 'exists:maritals,id'],
            'password' => ['required'],
            'profile_photo_path' => ['image', 'max:1024', 'nullable'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        if ($request->hasFile('profile_photo_path')) {
            $validated['profile_photo_path'] = $request
                ->file('profile_photo_path')
                ->store('public');
        }

        $user = $tribe->users()->create($validated);

        $user->syncRoles($request->roles);

        return new UserResource($user);
    }
}
