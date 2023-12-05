<?php

namespace App\Http\Controllers\Api;

use App\Models\Marital;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserCollection;

class MaritalUsersController extends Controller
{
    public function index(Request $request, Marital $marital): UserCollection
    {
        $this->authorize('view', $marital);

        $search = $request->get('search', '');

        $users = $marital
            ->users()
            ->search($search)
            ->latest()
            ->paginate();

        return new UserCollection($users);
    }

    public function store(Request $request, Marital $marital): UserResource
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
            'tribe_id' => ['required', 'exists:tribes,id'],
            'bloodtype_id' => ['required', 'exists:bloodtypes,id'],
            'password' => ['required'],
            'profile_photo_path' => ['image', 'max:1024', 'nullable'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        if ($request->hasFile('profile_photo_path')) {
            $validated['profile_photo_path'] = $request
                ->file('profile_photo_path')
                ->store('public');
        }

        $user = $marital->users()->create($validated);

        $user->syncRoles($request->roles);

        return new UserResource($user);
    }
}
