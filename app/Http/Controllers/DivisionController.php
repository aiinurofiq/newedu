<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\DivisionStoreRequest;
use App\Http\Requests\DivisionUpdateRequest;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Division::class);

        $search = $request->get('search', '');

        $divisions = Division::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.divisions.index', compact('divisions', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Division::class);

        return view('app.divisions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DivisionStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Division::class);

        $validated = $request->validated();

        $division = Division::create($validated);

        return redirect()
            ->route('divisions.edit', $division)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Division $division): View
    {
        $this->authorize('view', $division);

        return view('app.divisions.show', compact('division'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Division $division): View
    {
        $this->authorize('update', $division);

        return view('app.divisions.edit', compact('division'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        DivisionUpdateRequest $request,
        Division $division
    ): RedirectResponse {
        $this->authorize('update', $division);

        $validated = $request->validated();

        $division->update($validated);

        return redirect()
            ->route('divisions.edit', $division)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Division $division
    ): RedirectResponse {
        $this->authorize('delete', $division);

        $division->delete();

        return redirect()
            ->route('divisions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
