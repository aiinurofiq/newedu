<?php

namespace App\Http\Controllers;

use App\Models\Valvision;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ValvisionStoreRequest;
use App\Http\Requests\ValvisionUpdateRequest;

class ValvisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Valvision::class);

        $search = $request->get('search', '');

        $valvisions = Valvision::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.valvisions.index', compact('valvisions', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Valvision::class);

        return view('app.valvisions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValvisionStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Valvision::class);

        $validated = $request->validated();

        $valvision = Valvision::create($validated);

        return redirect()
            ->route('valvisions.edit', $valvision)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Valvision $valvision): View
    {
        $this->authorize('view', $valvision);

        return view('app.valvisions.show', compact('valvision'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Valvision $valvision): View
    {
        $this->authorize('update', $valvision);

        return view('app.valvisions.edit', compact('valvision'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ValvisionUpdateRequest $request,
        Valvision $valvision
    ): RedirectResponse {
        $this->authorize('update', $valvision);

        $validated = $request->validated();

        $valvision->update($validated);

        return redirect()
            ->route('valvisions.edit', $valvision)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Valvision $valvision
    ): RedirectResponse {
        $this->authorize('delete', $valvision);

        $valvision->delete();

        return redirect()
            ->route('valvisions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
