<?php

namespace App\Http\Controllers;

use App\Models\Religion;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ReligionStoreRequest;
use App\Http\Requests\ReligionUpdateRequest;

class ReligionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Religion::class);

        $search = $request->get('search', '');

        $religions = Religion::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.religions.index', compact('religions', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Religion::class);

        return view('app.religions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReligionStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Religion::class);

        $validated = $request->validated();

        $religion = Religion::create($validated);

        return redirect()
            ->route('religions.edit', $religion)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Religion $religion): View
    {
        $this->authorize('view', $religion);

        return view('app.religions.show', compact('religion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Religion $religion): View
    {
        $this->authorize('update', $religion);

        return view('app.religions.edit', compact('religion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ReligionUpdateRequest $request,
        Religion $religion
    ): RedirectResponse {
        $this->authorize('update', $religion);

        $validated = $request->validated();

        $religion->update($validated);

        return redirect()
            ->route('religions.edit', $religion)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Religion $religion
    ): RedirectResponse {
        $this->authorize('delete', $religion);

        $religion->delete();

        return redirect()
            ->route('religions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
