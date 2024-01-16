<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Dasarpertimbangan;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\DasarpertimbanganStoreRequest;
use App\Http\Requests\DasarpertimbanganUpdateRequest;

class DasarpertimbanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Dasarpertimbangan::class);

        $search = $request->get('search', '');

        $dasarpertimbangans = Dasarpertimbangan::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.dasarpertimbangans.index',
            compact('dasarpertimbangans', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Dasarpertimbangan::class);

        return view('app.dasarpertimbangans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        DasarpertimbanganStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', Dasarpertimbangan::class);

        $validated = $request->validated();

        $dasarpertimbangan = Dasarpertimbangan::create($validated);

        return redirect()
            ->route('dasarpertimbangans.edit', $dasarpertimbangan)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        Dasarpertimbangan $dasarpertimbangan
    ): View {
        $this->authorize('view', $dasarpertimbangan);

        return view(
            'app.dasarpertimbangans.show',
            compact('dasarpertimbangan')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        Dasarpertimbangan $dasarpertimbangan
    ): View {
        $this->authorize('update', $dasarpertimbangan);

        return view(
            'app.dasarpertimbangans.edit',
            compact('dasarpertimbangan')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        DasarpertimbanganUpdateRequest $request,
        Dasarpertimbangan $dasarpertimbangan
    ): RedirectResponse {
        $this->authorize('update', $dasarpertimbangan);

        $validated = $request->validated();

        $dasarpertimbangan->update($validated);

        return redirect()
            ->route('dasarpertimbangans.edit', $dasarpertimbangan)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Dasarpertimbangan $dasarpertimbangan
    ): RedirectResponse {
        $this->authorize('delete', $dasarpertimbangan);

        $dasarpertimbangan->delete();

        return redirect()
            ->route('dasarpertimbangans.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
