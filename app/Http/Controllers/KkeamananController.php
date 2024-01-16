<?php

namespace App\Http\Controllers;

use App\Models\Kkeamanan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\KkeamananStoreRequest;
use App\Http\Requests\KkeamananUpdateRequest;

class KkeamananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Kkeamanan::class);

        $search = $request->get('search', '');

        $kkeamanans = Kkeamanan::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.kkeamanans.index', compact('kkeamanans', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Kkeamanan::class);

        return view('app.kkeamanans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KkeamananStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Kkeamanan::class);

        $validated = $request->validated();

        $kkeamanan = Kkeamanan::create($validated);

        return redirect()
            ->route('kkeamanans.edit', $kkeamanan)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Kkeamanan $kkeamanan): View
    {
        $this->authorize('view', $kkeamanan);

        return view('app.kkeamanans.show', compact('kkeamanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Kkeamanan $kkeamanan): View
    {
        $this->authorize('update', $kkeamanan);

        return view('app.kkeamanans.edit', compact('kkeamanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        KkeamananUpdateRequest $request,
        Kkeamanan $kkeamanan
    ): RedirectResponse {
        $this->authorize('update', $kkeamanan);

        $validated = $request->validated();

        $kkeamanan->update($validated);

        return redirect()
            ->route('kkeamanans.edit', $kkeamanan)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Kkeamanan $kkeamanan
    ): RedirectResponse {
        $this->authorize('delete', $kkeamanan);

        $kkeamanan->delete();

        return redirect()
            ->route('kkeamanans.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
