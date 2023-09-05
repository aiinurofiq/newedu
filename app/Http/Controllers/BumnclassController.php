<?php

namespace App\Http\Controllers;

use App\Models\Bumnclass;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BumnclassStoreRequest;
use App\Http\Requests\BumnclassUpdateRequest;

class BumnclassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Bumnclass::class);

        $search = $request->get('search', '');

        $bumnclasses = Bumnclass::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.bumnclasses.index', compact('bumnclasses', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Bumnclass::class);

        return view('app.bumnclasses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BumnclassStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Bumnclass::class);

        $validated = $request->validated();

        $bumnclass = Bumnclass::create($validated);

        return redirect()
            ->route('bumnclasses.edit', $bumnclass)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Bumnclass $bumnclass): View
    {
        $this->authorize('view', $bumnclass);

        return view('app.bumnclasses.show', compact('bumnclass'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Bumnclass $bumnclass): View
    {
        $this->authorize('update', $bumnclass);

        return view('app.bumnclasses.edit', compact('bumnclass'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        BumnclassUpdateRequest $request,
        Bumnclass $bumnclass
    ): RedirectResponse {
        $this->authorize('update', $bumnclass);

        $validated = $request->validated();

        $bumnclass->update($validated);

        return redirect()
            ->route('bumnclasses.edit', $bumnclass)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Bumnclass $bumnclass
    ): RedirectResponse {
        $this->authorize('delete', $bumnclass);

        $bumnclass->delete();

        return redirect()
            ->route('bumnclasses.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
