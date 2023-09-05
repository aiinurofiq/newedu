<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\WifhusResource;
use App\Http\Resources\WifhusCollection;

class UserWifhusesController extends Controller
{
    public function index(Request $request, User $user): WifhusCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $wifhuses = $user
            ->wifhuses()
            ->search($search)
            ->latest()
            ->paginate();

        return new WifhusCollection($wifhuses);
    }

    public function store(Request $request, User $user): WifhusResource
    {
        $this->authorize('create', Wifhus::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'city_id' => ['required', 'exists:cities,id'],
            'birth' => ['required', 'date'],
            'gender_id' => ['required', 'exists:genders,id'],
            'as' => ['required', 'in:1,2'],
            'job' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
            'maritaldate' => ['required', 'date'],
        ]);

        $wifhus = $user->wifhuses()->create($validated);

        return new WifhusResource($wifhus);
    }
}
