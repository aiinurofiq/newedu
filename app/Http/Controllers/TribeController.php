<?php

namespace App\Http\Controllers;

use App\Models\Tribe;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TribeStoreRequest;
use App\Http\Requests\TribeUpdateRequest;

class TribeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Tribe::class);

        $search = $request->get('search', '');

        $tribes = Tribe::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.tribes.index', compact('tribes', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Tribe::class);

        return view('app.tribes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TribeStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Tribe::class);

        $validated = $request->validated();

        $tribe = Tribe::create($validated);

        return redirect()
            ->route('tribes.edit', $tribe)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Tribe $tribe): View
    {
        $this->authorize('view', $tribe);

        return view('app.tribes.show', compact('tribe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Tribe $tribe): View
    {
        $this->authorize('update', $tribe);

        return view('app.tribes.edit', compact('tribe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        TribeUpdateRequest $request,
        Tribe $tribe
    ): RedirectResponse {
        $this->authorize('update', $tribe);

        $validated = $request->validated();

        $tribe->update($validated);

        return redirect()
            ->route('tribes.edit', $tribe)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Tribe $tribe): RedirectResponse
    {
        $this->authorize('delete', $tribe);

        $tribe->delete();

        return redirect()
            ->route('tribes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
