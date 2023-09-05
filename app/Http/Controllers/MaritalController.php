<?php

namespace App\Http\Controllers;

use App\Models\Marital;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\MaritalStoreRequest;
use App\Http\Requests\MaritalUpdateRequest;

class MaritalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Marital::class);

        $search = $request->get('search', '');

        $maritals = Marital::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.maritals.index', compact('maritals', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Marital::class);

        return view('app.maritals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MaritalStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Marital::class);

        $validated = $request->validated();

        $marital = Marital::create($validated);

        return redirect()
            ->route('maritals.edit', $marital)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Marital $marital): View
    {
        $this->authorize('view', $marital);

        return view('app.maritals.show', compact('marital'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Marital $marital): View
    {
        $this->authorize('update', $marital);

        return view('app.maritals.edit', compact('marital'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        MaritalUpdateRequest $request,
        Marital $marital
    ): RedirectResponse {
        $this->authorize('update', $marital);

        $validated = $request->validated();

        $marital->update($validated);

        return redirect()
            ->route('maritals.edit', $marital)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Marital $marital
    ): RedirectResponse {
        $this->authorize('delete', $marital);

        $marital->delete();

        return redirect()
            ->route('maritals.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
