<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Fieldofposition;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\FieldofpositionStoreRequest;
use App\Http\Requests\FieldofpositionUpdateRequest;

class FieldofpositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Fieldofposition::class);

        $search = $request->get('search', '');

        $fieldofpositions = Fieldofposition::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.fieldofpositions.index',
            compact('fieldofpositions', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Fieldofposition::class);

        return view('app.fieldofpositions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        FieldofpositionStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', Fieldofposition::class);

        $validated = $request->validated();

        $fieldofposition = Fieldofposition::create($validated);

        return redirect()
            ->route('fieldofpositions.edit', $fieldofposition)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        Fieldofposition $fieldofposition
    ): View {
        $this->authorize('view', $fieldofposition);

        return view('app.fieldofpositions.show', compact('fieldofposition'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        Fieldofposition $fieldofposition
    ): View {
        $this->authorize('update', $fieldofposition);

        return view('app.fieldofpositions.edit', compact('fieldofposition'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        FieldofpositionUpdateRequest $request,
        Fieldofposition $fieldofposition
    ): RedirectResponse {
        $this->authorize('update', $fieldofposition);

        $validated = $request->validated();

        $fieldofposition->update($validated);

        return redirect()
            ->route('fieldofpositions.edit', $fieldofposition)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Fieldofposition $fieldofposition
    ): RedirectResponse {
        $this->authorize('delete', $fieldofposition);

        $fieldofposition->delete();

        return redirect()
            ->route('fieldofpositions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
