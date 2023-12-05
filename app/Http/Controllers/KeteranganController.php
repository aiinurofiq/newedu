<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Keterangan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\KeteranganStoreRequest;
use App\Http\Requests\KeteranganUpdateRequest;

class KeteranganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Keterangan::class);

        $search = $request->get('search', '');

        $keterangans = Keterangan::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.keterangans.index', compact('keterangans', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Keterangan::class);

        return view('app.keterangans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KeteranganStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Keterangan::class);

        $validated = $request->validated();

        $keterangan = Keterangan::create($validated);

        return redirect()
            ->route('keterangans.edit', $keterangan)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Keterangan $keterangan): View
    {
        $this->authorize('view', $keterangan);

        return view('app.keterangans.show', compact('keterangan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Keterangan $keterangan): View
    {
        $this->authorize('update', $keterangan);

        return view('app.keterangans.edit', compact('keterangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        KeteranganUpdateRequest $request,
        Keterangan $keterangan
    ): RedirectResponse {
        $this->authorize('update', $keterangan);

        $validated = $request->validated();

        $keterangan->update($validated);

        return redirect()
            ->route('keterangans.edit', $keterangan)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Keterangan $keterangan
    ): RedirectResponse {
        $this->authorize('delete', $keterangan);

        $keterangan->delete();

        return redirect()
            ->route('keterangans.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
