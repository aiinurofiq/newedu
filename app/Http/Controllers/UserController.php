<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use App\Models\Tribe;
use App\Models\Gender;
use App\Models\Marital;
use App\Models\Religion;
use App\Models\Bloodtype;
use App\Models\Bumnclass;
use Illuminate\View\View;
use App\Models\Bumnsector;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', User::class);

        $search = $request->get('search', '');

        $users = User::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.users.index', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', User::class);

        $cities = City::pluck('name', 'id');
        $genders = Gender::pluck('name', 'id');
        $religions = Religion::pluck('name', 'id');
        $tribes = Tribe::pluck('name', 'id');
        $bloodtypes = Bloodtype::pluck('name', 'id');
        $maritals = Marital::pluck('name', 'id');

        $roles = Role::get();
        $bumnsectors = Bumnsector::get();
        $bumnclasses = Bumnclass::get();

        return view(
            'app.users.create',
            compact(
                'cities',
                'genders',
                'religions',
                'tribes',
                'bloodtypes',
                'maritals',
                'roles',
                'bumnsectors',
                'bumnclasses'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */

    // ...
    
    public function store(UserStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', User::class);
    
        $validated = $request->validated();
    
        // Generate UUID
        $validated['uuid'] = Str::uuid();
    
        $validated['password'] = Hash::make($validated['password']);
    
        if ($request->hasFile('profile_photo_path')) {
            $validated['profile_photo_path'] = $request
                ->file('profile_photo_path')
                ->store('public');
        }
    
        $user = User::create($validated);
    
        $user->bumnsectors()->attach($request->bumnsectors);
        $user->bumnclasses()->attach($request->bumnclasses);
    
        $user->syncRoles($request->roles);
    
        return redirect()
            ->route('users.edit', $user)
            ->withSuccess(__('crud.common.created'));
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Request $request, User $user): View
    {
        $this->authorize('view', $user);

        return view('app.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, User $user): View
    {
        $this->authorize('update', $user);

        $cities = City::pluck('name', 'id');
        $genders = Gender::pluck('name', 'id');
        $religions = Religion::pluck('name', 'id');
        $tribes = Tribe::pluck('name', 'id');
        $bloodtypes = Bloodtype::pluck('name', 'id');
        $maritals = Marital::pluck('name', 'id');

        $roles = Role::get();
        $bumnsectors = Bumnsector::get();
        $bumnclasses = Bumnclass::get();

        return view(
            'app.users.edit',
            compact(
                'user',
                'cities',
                'genders',
                'religions',
                'tribes',
                'bloodtypes',
                'maritals',
                'roles',
                'bumnsectors',
                'bumnclasses'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
    $this->authorize('update', $user);

    $validated = $request->validated();

    if (empty($validated['password'])) {
        unset($validated['password']);
    } else {
        $validated['password'] = Hash::make($validated['password']);
    }

    if ($request->hasFile('profile_photo_path')) {
        if ($user->profile_photo_path) {
            Storage::delete($user->profile_photo_path);
        }

        $validated['profile_photo_path'] = $request
            ->file('profile_photo_path')
            ->store('public');
    }

    $user->bumnsectors()->sync($request->bumnsectors);
    $user->bumnclasses()->sync($request->bumnclasses);

    // Update UUID based on input
    $user->uuid = $validated['uuid'];

    // Update user data
    $user->update($validated);

    $user->syncRoles($request->roles);

    return redirect()
        ->route('users.edit', $user)
        ->withSuccess(__('crud.common.saved'));
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user): RedirectResponse
    {
        $this->authorize('delete', $user);

        if ($user->profile_photo_path) {
            Storage::delete($user->profile_photo_path);
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
