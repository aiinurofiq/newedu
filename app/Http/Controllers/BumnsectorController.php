<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Bumnsector;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BumnsectorStoreRequest;
use App\Http\Requests\BumnsectorUpdateRequest;

class BumnsectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Bumnsector::class);

        $search = $request->get('search', '');

        $bumnsectors = Bumnsector::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.bumnsectors.index', compact('bumnsectors', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Bumnsector::class);

        return view('app.bumnsectors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BumnsectorStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Bumnsector::class);

        $validated = $request->validated();

        $bumnsector = Bumnsector::create($validated);

        return redirect()
            ->route('bumnsectors.edit', $bumnsector)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Bumnsector $bumnsector): View
    {
        $this->authorize('view', $bumnsector);

        return view('app.bumnsectors.show', compact('bumnsector'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Bumnsector $bumnsector): View
    {
        $this->authorize('update', $bumnsector);

        return view('app.bumnsectors.edit', compact('bumnsector'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        BumnsectorUpdateRequest $request,
        Bumnsector $bumnsector
    ): RedirectResponse {
        $this->authorize('update', $bumnsector);

        $validated = $request->validated();

        $bumnsector->update($validated);

        return redirect()
            ->route('bumnsectors.edit', $bumnsector)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Bumnsector $bumnsector
    ): RedirectResponse {
        $this->authorize('delete', $bumnsector);

        $bumnsector->delete();

        return redirect()
            ->route('bumnsectors.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
